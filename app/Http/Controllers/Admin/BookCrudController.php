<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BookRequest as StoreRequest;
use App\Http\Requests\BookRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class BookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BookCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Book');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/book');
        $this->crud->setEntityNameStrings('книгу', 'книги');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();
        $this->crud->setFieldLabel('name', 'Название');
        $this->crud->setColumnLabel('name', 'Название');
        $this->crud->setFieldLabel('price', 'Цена');
        $this->crud->setColumnLabel('price', 'Цена');
        
        $this->crud->addField(
                [// Select2
                    'label' => "Автор",
                    'type' => 'select2',
                    'name' => 'author_id', // the db column for the foreign key
                    'entity' => 'author', // the method that defines the relationship in your Model
                    'attribute' => 'FIO', // foreign key attribute that is shown to user
                    'model' => "App\Models\Author", // foreign key model
                ]
        );
        
        $this->crud->addColumn(
                [
                    // 1-n relationship
                    'label' => "Автор", // Table column heading
                    'type' => "select",
                    'name' => 'author_id', // the column that contains the ID of that connected entity;
                    'entity' => 'author', // the method that defines the relationship in your Model
                    'attribute' => "FIO", // foreign key attribute that is shown to user
                    'model' => "App\Models\Author", // foreign key model
                ]
        );
        // add asterisk for fields that are required in BookRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
