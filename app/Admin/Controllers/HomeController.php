<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $grid = new Grid(new User);

        $grid->column('id', 'ID')->sortable();
        $grid->column('first_name', 'Prénom');
        $grid->column('last_name', 'Nom');
        $grid->column('created_at', 'created_at')->sortable();

        $grid->filter(function ($filter) {
            // Sets the range query for the created_at field
            $filter->between('created_at', 'Created Time')->datetime();
        });

        return $content
            ->title('Utilisateurs')
            ->description('La liste des utilisateurs inscrits à l\'application.')
            ->row($grid->render())
        ;
    }
}
