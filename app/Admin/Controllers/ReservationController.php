<?php

namespace App\Admin\Controllers;

use App\Models\Room;
use App\Models\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Reservation;
use App\Admin\Forms\AddRoom;
use App\Admin\Forms\UpdateRoom;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\AdminController;

class ReservationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reservation Controller';

    /**
     * Make a grid builder for list records.
     *
     * @return Content
     */
    protected function gridReservation(Content $content)
    {
        $grid = new Grid(new Reservation);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('room', 'Salle')->display(function($field) {
            $field = Room::find($field);
            return $field->name;
        });
        $grid->column('user', 'Utilisateur')->display(function($field) {
            $field = User::find($field);
            return $field->first_name . ' ' . $field->last_name;
        });
        $grid->column('start_at', 'Date de début')->datetime();
        $grid->column('end_at', 'Date de fin')->datetime();
        $grid->column('status', 'Status');
        $grid->column('created_at', 'Créer le')->sortable();
        $grid->column('updated_at', 'Modifier le')->sortable();

        return $content
            ->title('Réservations')
            ->description('La liste des réservations.')
            ->row($grid->render())
        ;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Content
     */
    protected function detailRoom($id, Content $content)
    {
        $room = Room::findOrFail($id);
        $show = new Show($room);

        $show->field('id', __('ID'));
        $show->field('name', 'Nom');
        $show->field('description', 'Description');
        $show->field('image', 'Image')->image('https://wonderful-lamarr.139-99-210-151.plesk.page', 400, 250);
        $show->field('pin', 'Port')->badge();
        $show->field('is_reserved', 'Réservé ?')->as(function($field) {
            return $field ? 'Oui' : 'Non';
        });
        $show->field('created_at', 'Créer le');
        $show->field('updated_at', 'Modifier le');

        return $content
            ->title($room->name)
            ->body($show->render())
        ;
    }

    /**
     * Make a form builder.
     *
     * @return Content
     */
    protected function addRoom(Content $content)
    {
        return $content
            ->title('Ajouter une salle')
            ->body(AddRoom::class)
        ;
    }

    /**
     * Make a form builder.
     *
     * @return Content
     */
    protected function editRoom($id, Content $content)
    {
        $room = Room::findOrFail($id);
        // $form = new Form(new Room);

        // $form->text('name', 'Nom')->rules('required', [
        //     'required' => 'Ce champ est requis.'
        // ])->value($room->name);
        // $form->textarea('description', 'Description')->rules('required', [
        //     'required' => 'Ce champ est requis.'
        // ])->value($room->description);
        // $form->image('image', 'Image')->rules('required|image|max:2000', [
        //     'required' => 'Ce champ est requis.',
        //     'image' => 'Le fichier doit être une image.',
        //     'max' => 'L\'image ne doit pas faire plus de 2Mo.'
        // ])->value($room->image);
        // $form->number('pin', 'Port')->rules('required', [
        //     'required' => 'Ce champ est requis.'
        // ])->value($room->pin);
        // $form->switch('is_reserved', 'Réservé ?')->rules('required', [
        //     'required' => 'Ce champ est requis.'
        // ])->value($room->is_reserved);

        // $form->setAction('/admin/rooms/' . $room->id . '/edit');

        // $form->saving(function($request) {
        //     dd($request);
        // });
        $form = new UpdateRoom;
        $form->setRoom($room);

        return $content
            ->title($room->name)
            ->body($form)
        ;
    }
}
