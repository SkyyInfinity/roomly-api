<?php

namespace App\Admin\Forms;

use App\Models\Room;
use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Query\Builder;

class UpdateRoom extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Edit';

    protected $room;

    public function setRoom($room)
    {
        $this->room = $room;
    }
    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $data = $request->all();

        /** @var UploadedFile|null $image */
        $image = $data['image'];
        $imagePath = 'https://wonderful-lamarr.139-99-210-151.plesk.page/storage/' . $image->store('rooms', 'public');

        // FIXME: find don't work
        // get one by id
        $room = Room::find($this->room['id']);
        $room->update([
            'name' => ucfirst($data['name']) || $this->room['name'],
            'description' => ucfirst($data['description']) || $this->room['description'],
            'image' => $imagePath || $this->room['image'],
            'pin' => $data['pin'] || $this->room['pin'],
            'is_reserved' => $data['is_reserved'] || $this->room['is_reserved']
        ]);

        admin_success('La salle à bien été modifier.');

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
        return [
            'name'        => $this->room['name'],
            'description' => $this->room['description'],
            'image'       => $this->room['image'],
            'pin'         => $this->room['pin'],
            'is_reserved' => $this->room['is_reserved']
        ];
    }
}
