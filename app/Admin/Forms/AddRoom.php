<?php

namespace App\Admin\Forms;

use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\UploadedFile;
use App\Models\Room;

class AddRoom extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Room';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        /** @var UploadedFile|null $image */
        $image = $request->image;
        $imagePath = 'https://wonderful-lamarr.139-99-210-151.plesk.page/storage/' . $image->store('rooms', 'public');

        Room::create([
            'name' => ucfirst($request->name),
            'description' => ucfirst($request->description),
            'image' => $imagePath,
            'pin' => $request->pin || null,
            'is_reserved' => $request->is_reserved || false
        ]);

        admin_success('La salle à bien été ajouté.');

        return redirect('/admin/rooms');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('name', 'Nom')->rules('required', [
            'required' => 'Ce champ est requis.'
        ]);
        $this->textarea('description', 'Description')->rules('required', [
            'required' => 'Ce champ est requis.'
        ]);
        $this->image('image', 'Image')->rules('required|image|max:2000', [
            'required' => 'Ce champ est requis.',
            'image' => 'Le fichier doit être une image.',
            'max' => 'L\'image ne doit pas faire plus de 2Mo.'
        ]);
        $this->number('pin', 'Port')->rules('required', [
            'required' => 'Ce champ est requis.'
        ]);
        $this->switch('is_reserved', 'Réservé ?')->rules('required', [
            'required' => 'Ce champ est requis.'
        ]);
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [];
    }
}
