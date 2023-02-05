<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPhotoRequest;
use App\Http\Requests\CreateAlbumRequest;
use App\Models\Album;
use App\Models\Photo;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class AlbumController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getList(): Factory|View|Application
    {
        $albums = Album::where('user_id', '!=', Auth::id())->with('photos')->get();
        return view('albums.index', ['albums' => $albums]);
    }

    public function getOwnList(): Factory|View|Application
    {
        $albums = Album::where('user_id', Auth::id())->with('photos')->get();
        return view('albums.index', ['albums' => $albums]);
    }

    public function getAlbum($id): Factory|View|Application
    {
        $album = Album::with('photos')->find($id);
        return view('albums.show', ['album' => $album]);
    }

    public function getForm(): Factory|View|Application
    {
        return view('albums.create');
    }

    public function create(CreateAlbumRequest $request): RedirectResponse
    {
        $userId = Auth::id();
        $file = $request->file('cover_image');
        $random_name = $request->file('cover_image')->getClientOriginalName();
        $destinationPath = 'albums/';
        $extension = $file->getClientOriginalExtension();
        $filename = $random_name . '_cover.' . $extension;
        $request->file('cover_image')->move($destinationPath, $filename);
        $album = Album::create(
            array(
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'cover_image' => $filename,
                'user_id' => $userId
            )
        );

        return redirect()->route('get-album', ['id' => $album->id]);
    }

    public function delete($id): RedirectResponse
    {
        $album = Album::find($id);
        if (Auth::id() != $album->user->id) {
            throw new Exception("Not authorized");
        }

        $album->delete();

        return redirect()->route('own-albums');
    }

    public function addPhoto($id, AddPhotoRequest $request): RedirectResponse
    {
        $file = $request->file('image');
        $name = $request->get('name');
        $destinationPath = 'albums/' . $id . '/';
        $extension = $file->getClientOriginalExtension();
        $filename = $name . '_img.' . $extension;
        $request->file('image')->move($destinationPath, $filename);
        Photo::create(
            array(
                'album_id' => $id,
                'description' => $request->get('description'),
                'image' => $filename,
            )
        );
        return redirect()->route('get-album', ['id' => $id]);
    }

    public function getPhotoForm($id)
    {
        return view('albums.create-photo', ['id' => $id]);
    }

    public function deletePhoto($id)
    {
        $photo = Photo::find($id);
        if (Auth::id() != $photo->album->user->id) {
            throw new Exception("Not authorized");
        }

        if (!$photo) {
            return null;
        }

        $albumId = $photo->album_id;
        $photo->delete();
        return redirect()->route('get-album', ['id' => $albumId]);
    }
}