<?php

namespace Database;

use function Siler\Http\session;
use function Siler\Http\setsession;
use function Validators\setErrorAndRedirect;

function savePlaylist($name, $user_id)
{
    $query = pdo()->prepare('SELECT * FROM playlists WHERE name=:name');
    $query->execute(compact('name'));
    $playlist = $query->fetch(\PDO::FETCH_ASSOC);
    if (!empty($playlist)) {
        setErrorAndRedirect('Playlist already exist');
    }
    pdo()
        ->prepare(
            "INSERT INTO playlists (name, user_id)
            VALUES (:name, :user_id);"
        )
        ->execute(compact('name', 'user_id'));
    $playlist_id = pdo()->lastInsertID();
    setsession('infoAlert', 'Playlist created successfully');
    return $playlist_id;
}

function saveSong($name, $url, $youtube_id)
{
    $query = pdo()->prepare('SELECT * FROM songs WHERE youtube_id=:youtube_id');
    $query->execute(compact('youtube_id'));
    $song = $query->fetch(\PDO::FETCH_ASSOC);
    if (!empty($song)) {
        $song_id = $song['id'];
    } else {
        pdo()
            ->prepare(
                "INSERT INTO songs (name, url, youtube_id)
                VALUES (:name, :url, :youtube_id)"
            )
            ->execute(compact('name', 'url', 'youtube_id'));
        $song_id = pdo()->lastInsertId();
    }
    return $song_id;
}

function addSongToPlaylist($song_id, $playlist_id)
{
    $query = pdo()->prepare('SELECT * FROM playlist_items WHERE song_id=:song_id AND playlist_id=:playlist_id');
    $query->execute(compact('song_id', 'playlist_id'));
    $playlist_item = $query->fetch(\PDO::FETCH_ASSOC);

    if (!empty($playlist_item)) {
        setErrorAndRedirect('Song already exist in this playlist');
    }

    pdo()
        ->prepare(
            "INSERT INTO playlist_items (song_id, playlist_id)
            VALUES (:song_id, :playlist_id)"
        )
        ->execute(compact('song_id', 'playlist_id'));

    setsession('infoAlert', 'Song added successfully');
}

function upVoteSong(Int $userId, Int $playlistId, Int $songId) {
    $playlistItemQuery = pdo()
        ->prepare(
            "SELECT id FROM playlist_items
            WHERE playlist_id = :playlistId
            AND song_id = :songId;");

    $playlistItemQuery->execute(compact('playlistId', 'songId'));
    $playlistItem = $playlistItemQuery->fetch(\PDO::FETCH_ASSOC);
    $playlistItemId = $playlistItem['id'];


    $insertQuery = pdo()
        ->prepare(
            "INSERT INTO upvotes (user, playlist_item)
            VALUES (:userId, :playlistItemId)"
        );
    $insertQuery->bindParam('userId', $userId, \PDO::PARAM_INT);
    $insertQuery->bindParam('playlistItemId', $playlistItemId, \PDO::PARAM_INT);

    $success = $insertQuery->execute();

    if(!$success) {
        setErrorAndRedirect('Upvote failed, you have already upvoted this song');
    }
    setsession('infoAlert', 'Upvote successfully');
}

function getPlaylist($id){
    $playlistMetaQuery = pdo()->prepare(
        'SELECT * FROM playlists WHERE id=:id;'
    );
    $playlistMetaQuery->execute(compact('id'));
    $playlistMeta = $playlistMetaQuery->fetch(\PDO::FETCH_ASSOC);

    $playlistItemQuery = pdo()->prepare(
        'SELECT s.*, count(DISTINCT uv.playlist_item) AS upvote
        FROM playlists as pl
        LEFT JOIN playlist_items as pli
        ON pl.id = pli.playlist_id
        LEFT JOIN songs as s
        ON pli.song_id = s.id
        LEFT JOIN upvotes as uv
        ON pli.id = uv.playlist_item
        WHERE pl.id=:id
        GROUP BY s.id
        ORDER BY upvote DESC'
    );
    $playlistItemQuery->bindParam('id', $id, \PDO::PARAM_INT);
    $playlistItemQuery->execute();

    $playlistItems = $playlistItemQuery->fetchALL(\PDO::FETCH_ASSOC);

    /**
     * Fillter out all empty results
     */
    $playlistItems = array_filter($playlistItems, fn ($item) => $item['id'] !== null);

    $data = [
        'meta' => $playlistMeta,
        'songs' => $playlistItems
    ];

    return $data;
}
