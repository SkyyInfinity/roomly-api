<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\AddRoom;
use App\Admin\Forms\UpdateRoom;
use App\Models\Room;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RoomController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Room Controller';

    /**
     * Make a grid builder for list records.
     *
     * @return Content
     */
    protected function gridRoom(Content $content)
    {
        $grid = new Grid(new Room);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', 'Nom');
        $grid->column('description', 'Description')->style('
            width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        ');
        $grid->column('image', 'Image')->image();
        $grid->column('pin', 'Port');
        $grid->column('is_reserved', 'Réservé ?')->bool();
        $grid->column('created_at', 'Créer le')->sortable();
        $grid->column('updated_at', 'Modifier le')->sortable();

        return $content
            ->title('Salles')
            ->description('La liste des salles de votre établissement.')
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
