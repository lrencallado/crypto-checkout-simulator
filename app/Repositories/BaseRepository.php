<?php

namespace App\Repositories;

abstract class BaseRepository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    abstract protected function model();

    /**
     * BaseRepository constructor.
     *
     * Initializes the repository by resolving and assigning the model instance
     * using the Laravel service container. The specific model class is determined
     * by the implementation of the model() method in the concrete repository.
     */
    public function __construct()
    {
        $this->model = app($this->model());
    }

    /**
     * Create a new record in the database with the provided data.
     *
     * @param array $data The data to be used for creating the new record.
     * @return \Illuminate\Database\Eloquent\Model The newly created model instance.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Get all records from the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }
}
