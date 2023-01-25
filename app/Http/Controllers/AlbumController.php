<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlbumRequest;
use App\Models\Album;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class AlbumController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getList(): Factory|View|Application
    {
        $albums = Album::with('photos')->get();
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
        $file = $request->file('cover_image');
        $random_name = 'random name';
        $destinationPath = 'albums/';
        $extension = $file->getClientOriginalExtension();
        $filename = $random_name . '_cover.' . $extension;
        $uploadSuccess = $request->file('cover_image')->move($destinationPath, $filename);
        $album = Album::create(array(
                                   'name' => $request->get('name'),
                                   'description' => $request->get('description'),
                                   'cover_image' => $filename,
                               ));

        return redirect()->route('get-album', ['id' => $album->id]);
    }

    public function delete($id): RedirectResponse
    {
        $album = Album::find($id);

        $album->delete();

        return redirect()->route('list-of-albums');
    }

    public function addPhoto()
    {
    }
}
