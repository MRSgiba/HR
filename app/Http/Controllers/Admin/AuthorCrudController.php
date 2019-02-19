<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AuthorRequest as StoreRequest;
use App\Http\Requests\AuthorRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class AuthorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AuthorCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Author');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/author');
        $this->crud->setEntityNameStrings('автора', 'авторы');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();
        $this->crud->setFieldLabel('FIO', 'ФИО');        
        $this->crud->setColumnLabel('FIO', 'ФИО');
        
        $this->crud->addColumn([
            'name' => "count",
            'label' => "Количество книг", // Table column heading
            'type' => "model_function",
            'function_name' => 'bookscount', // the method in your Model
            // 'function_parameters' => [$one, $two], // pass one/more parameters to that method
            //'attribute' => 'route',
            // 'limit' => 100, // Limit the number of characters shown
        ]);        
        
        // add asterisk for fields that are required in AuthorRequest
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
