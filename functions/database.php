<?php

namespace Database;

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
                //need to change link to url in db
                "INSERT INTO songs (name, link, youtube_id)
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

function getPlaylist($id){
    $playlistMetaQuery = pdo()->prepare(
        'SELECT * FROM playlists WHERE id=:id;'
    );
    $playlistMetaQuery->execute(compact('id'));
    $playlistMeta = $playlistMetaQuery->fetch(\PDO::FETCH_ASSOC);

    $playlistItemQuery = pdo()->prepare(
        'SELECT s.* FROM playlists as pl
        LEFT JOIN playlist_items as pli
        ON pl.id = pli.playlist_id
        LEFT JOIN songs as s
        ON pli.song_id = s.id
        WHERE pl.id=:id;'
    );
    $playlistItemQuery->bindParam('id', $id, \PDO::PARAM_INT);
    $playlistItemQuery->execute();

    $playlist = $playlistItemQuery->fetchALL(\PDO::FETCH_ASSOC);
    $data = [
        'meta' => $playlistMeta,
        'songs' => $playlist
    ];

    return $data;
}
