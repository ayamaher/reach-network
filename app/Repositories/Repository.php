<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }


    public function get()
    {
        return $this->model->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }


    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }




    // remove record from the database
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);

        return $record->destroy($id);
    }


    // show the record with the given id
    public function find($id)
    {
        return $this->model->find($id);
    }


    public function exists($id, $column = 'id')
    {
        return $this->model->where($column, $id)->exists();
    }


    // update record or create it if not exist
    public function updateOrCreate($data, $data2)
    {
        return $this->model->updateOrCreate($data, $data2);
    }



    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }


    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }


}
