<?php

namespace App\Admin\Controllers;

use App\Models\Room;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pages Controller';

    /**
     * Make a grid builder.
     *
     * @return Content
     */
    protected function rooms(Content $content)
    {
        $grid = new Grid(new Room());

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
        $grid->column('is_reserved', 'Réserver ?')->bool();
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
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ExampleModel::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ExampleModel);

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }
}
