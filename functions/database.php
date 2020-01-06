<?php

namespace Database;

use function Siler\Http\setsession;
use function Validators\setErrorAndRedirect;

/**
 * Get the song with the given id from the database
 *
 * @param integer $id
 * @return array
 */
function getSongById($id)
{
    return __selectOneById('songs', $id);
}

/**
 * Get all the song from the database
 *
 * @return array
 */
function getAllSongs($limit = 50, $start = 0)
{
    $query = pdo()->prepare(
        'SELECT name, link, youtube_id FROM songs LIMIT :start,:limit;'
    );
    $query->bindParam('limit', $limit, \PDO::PARAM_INT);
    $query->bindParam('start', $start, \PDO::PARAM_INT);
    return __executeQuery($query);
}

/**
 * Get the owner of the playlist
 *
 * @param integer $playlistId
 * @return integer
 */
function getPlaylistOwnerId($playlistId)
{
    return (int) __selectOneById('playlists', $playlistId)['user_id'];
}

/**
 * Store a song in the database
 *
 * @param string $name
 * @param string $url
 * @param string $youtube_id
 * @return array
 */
function storeSong($name, $url, $youtube_id)
{
    $query = pdo()->prepare('SELECT * FROM songs WHERE youtube_id=:youtube_id');
    $song = __executeQuery($query, compact('youtube_id'), false);

    if (!empty($song)) {
        return $song['id'];
    }

    pdo()->prepare(
        "INSERT INTO songs (name, url, youtube_id)
            VALUES (:name, :url, :youtube_id)"
    )
        ->execute(compact('name', 'url', 'youtube_id'));

    return pdo()->lastInsertId();
}

/**
 * Add the song with the given id to a playlist
 *
 * @param integer $songId
 * @param integer $playlistId
 * @return void
 */
function addSongToPlaylist($songId, $playlistId)
{
    $query = pdo()
        ->prepare(
            'SELECT * FROM playlist_items
            WHERE song_id=:songId
            AND playlistId=:playlistId'
        );

    $playlistItem = __executeQuery($query, compact('songId', 'playlistId'));

    if (!empty($playlistItem)) {
        setErrorAndRedirect('Song already exist in this playlist');
    }

    pdo()
        ->prepare(
            "INSERT INTO playlist_items (song_id, playlist_id)
            VALUES (:songId, :playlistId)"
        )
        ->execute(compact('songId', 'playlistId'));

    setsession('infoAlert', 'Song added successfully');
}

/**
 * Store a up Vote for a song in a playlist i the database
 *
 * @param integer $userId
 * @param integer $playlistId
 * @param integer $songId
 * @return boolean
 */
function upVoteSong($userId, $playlistId, $songId)
{
    $playlistItemQuery = pdo()
        ->prepare(
            "SELECT id FROM playlist_items
            WHERE playlist_id = :playlistId
            AND song_id = :songId;"
        );

    $playlistItem = __executeQuery(
        $playlistItemQuery,
        compact('playlistId', 'songId'),
        false
    );

    $playlistItemId = $playlistItem['id'];

    $insertQuery = pdo()
        ->prepare(
            "INSERT INTO upvotes (user, playlist_item)
            VALUES (:userId, :playlistItemId)"
        );

    $insertQuery->bindParam('userId', $userId, \PDO::PARAM_INT);
    $insertQuery->bindParam('playlistItemId', $playlistItemId, \PDO::PARAM_INT);

    return !!$insertQuery->execute();
}

/**
 * Get all playlists in the database
 *
 * @param integer $limit
 * @param integer $start
 * @return array
 */
function getAllPlaylists($limit = 50, $start = 0)
{
    $query = pdo()->prepare(
        'SELECT name, created, id, user_id FROM playlists LIMIT :start,:limit;'
    );
    $query->bindParam('limit', $limit, \PDO::PARAM_INT);
    $query->bindParam('start', $start, \PDO::PARAM_INT);

    return __executeQuery($query);
}

/**
 * Get all palylists from the user with the given id from the database.
 *
 * @param integer $id
 * @param integer $limit
 * @param integer $page
 * @return void
 */
function getPlaylistsByUser($id, $limit = 5, $page = 1)
{
    $start = (int) $limit * ($page - 1);
    $query = pdo()->prepare(
        'SELECT * FROM playlists
        WHERE user_id=:id
        ORDER BY created DESC
        LIMIT :start,:limit;'
    );
    $query->bindParam('id', $id, \PDO::PARAM_INT);
    $query->bindParam('start', $start, \PDO::PARAM_INT);
    $query->bindParam('limit', $limit, \PDO::PARAM_INT);

    return __executeQuery($query);
}

/**
 * Get count of all playlists from the user.
 *
 * @param integer $id
 * @return integer
 */
function countOfPlaylistsByUser($id)
{
    $query = pdo()
        ->prepare(
            'SELECT count(id) as count from playlists WHERE user_id=:id;'
        );
    $query->bindParam('id', $id, \PDO::PARAM_INT);
    $result = __executeQuery($query, null, false);

    return $result['count'];
}

/**
 * Get the playlist with the given id
 *
 * @param integer $id
 * @return array
 */
function getPlaylist($id)
{
    $playlistMeta = __selectOneById('playlists', $id);

    $playlistItemQuery = pdo()->prepare(
        'SELECT s.*, count(uv.playlist_item) upvote, min(uv.created) timevote
        FROM playlists as pl
        LEFT JOIN playlist_items as pli
        ON pli.playlist_id = pl.id
        LEFT JOIN songs as s
        ON s.id = pli.song_id
        LEFT JOIN upvotes as uv
        ON uv.playlist_item = pli.id
        WHERE pl.id=:id
        GROUP BY s.id
        order by upvote desc, timevote'
    );
    $playlistItemQuery->bindParam('id', $id, \PDO::PARAM_INT);

    $playlistItems = __executeQuery($playlistItemQuery);

    /**
     * Filter out all empty results
     */
    $playlistItems = array_filter($playlistItems, fn ($item) => $item['id'] !== null);

    return [
        'meta' => $playlistMeta,
        'songs' => $playlistItems
    ];
}

/**
 * Store a playlist in the database
 *
 * @param string $name
 * @param integer $user_id
 * @return void
 */
function storePlaylist($name, $userId)
{
    $playlist = __selectOneByName('playlists', $name);
    if (!empty($playlist)) {
        setErrorAndRedirect('Playlist already exist');
    }

    pdo()
        ->prepare(
            "INSERT INTO playlists (name, user_id)
            VALUES (:name, :userId);"
        )
        ->execute(compact('name', 'userId'));

    $playlistId = pdo()->lastInsertID();

    setsession('infoAlert', 'Playlist created successfully');

    return $playlistId;
}

/**
 * Get User with the given Id from the database.
 *
 * @param integer $id
 * @return array
 */
function getUserById($id)
{
    $query = pdo()->prepare(
        'SELECT username, email, id FROM users WHERE id=:id;'
    );
    $query->bindParam('id', $id, \PDO::PARAM_INT);
    return __executeQuery($query, null, false);
}

/**
 * Get User with the given Username from the database.
 *
 * @param string $username
 * @return array
 */
function getUserByName($username)
{
    return __selectByField('users', 'username', compact('username'), false);
}

/**
 * Get all users from the database
 *
 * @param integer $limit
 * @param integer $start
 * @return array
 */
function getAllUsers($limit = 50, $start = 0)
{
    $query = pdo()->prepare(
        'SELECT username, email, id FROM users LIMIT :start,:limit;'
    );
    $query->bindParam('limit', $limit, \PDO::PARAM_INT);
    $query->bindParam('start', $start, \PDO::PARAM_INT);
    return __executeQuery($query);
}

/**
 * Store the user in the database
 *
 * @param string $email
 * @param string $username
 * @param string $password
 * @return boolen
 */
function storeUser($email, $username, $password)
{
    return !!pdo()
    ->prepare(
        "INSERT INTO users (username, password, email)
        VALUES (:username, :password, :email)"
    )
    ->execute(compact('username', 'password', 'email'));
}

/**
 * Update the password of the user
 *
 * @param integer $id
 * @param string $password
 * @return boolen
 */
function updateUserPassword($id, $newPassword)
{
    return !!pdo()
        ->prepare(
            'UPDATE users SET `password` = :newPassword
            WHERE id=:id'
        )
        ->execute(compact('id', 'newPassword'));
}

/**
 * deletes the playlist and every entity witch is related to the playlist
 *
 * @param integer $playlist_id
 * @return boolen
 */
function deletePlaylist($playlistId)
{
    $id = __selectByField('playlist_items', 'playlist_id', ['playlist_id' => $playlistId])['id'];

    $upvotesQuery = pdo()->prepare('DELETE FROM upvotes where playlist_item=:id');
    $upvotesQuery->execute(compact('id'));
    $playlistItemsQuery = pdo()->prepare('DELETE FROM playlist_items where id=:id');
    $playlistItemsQuery->execute(compact('id'));
    $playlistsQuery = pdo()->prepare('DELETE FROM playlists where id=:id');
    return !!$playlistsQuery->execute(['id'=>$playlistId]);
}

/**
 * Returns the count of entries in a given table
 *
 * @param string $table
 * @return integer
 */
function countOf($table)
{
    return pdo()->query("SELECT count(id) as count from $table;")
        ->fetch(\PDO::FETCH_ASSOC)['count'];
}


/**
 * Select one entry from a table by Name, this function is unsafe and only
 * intended for private API as suggested by the __ at the beginning of
 * the function name.
 *
 * @param string $table
 * @param string $name
 * @return array
 */
function __selectOneByName($table, $name)
{
    $query = pdo()->prepare("SELECT * FROM $table WHERE name=:name");
    $query->bindParam('name', $name, \PDO::PARAM_STR);
    return __executeQuery($query, null, false);
}

/**
 * Select one entry from a table by ID, this function is unsafe and only
 * intended for private API as suggested by the __ at the beginning of
 * the function name.
 *
 * @param string $table
 * @param integer $id
 * @return array
 */
function __selectOneById($table, $id)
{
    $query = pdo()->prepare("SELECT * FROM $table WHERE id=:id");
    $query->bindParam('id', $id, \PDO::PARAM_INT);
    return __executeQuery($query, null, false);
}

/**
 * Select all entries from a table by the supplied, this function is unsafe and
 * only intended for private API as suggested by the __ at the beginning of
 * the function name.
 *
 * @param string $table
 * @param string $field
 * @param array $data
 * @param boolean $fetchAll
 * @return array
 */
function __selectByField($table, $field, $data, $fetchAll = false)
{
    $query = pdo()->prepare("SELECT * FROM $table WHERE $field=:$field");
    return __executeQuery($query, $data, $fetchAll);
}

/**
 * Execute a prepared PDO query.
 * The user has the option to provide a data array and to change default fetch
 * method.
 *
 * @param \PDOStatement $query
 * @param array $data
 * @param boolean $fetchAll
 * @return array
 */
function __executeQuery($query, $data = null, $fetchAll = true)
{
    if ($data) {
        $query->execute($data);
    } else {
        $query->execute();
    }
    if ($fetchAll) {
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    return $query->fetch(\PDO::FETCH_ASSOC);
}
