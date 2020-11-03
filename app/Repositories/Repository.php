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

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->find($id);

        if($record != null){
            return $record->update($data);
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getModel(){
        return $this->model;
    }

    public function setModel($model){
        $this->model = $model;
    }

    public function with($relations){
        return $this->model->with($relations);
    }

    public function where(array $data, $orderBy)
    {
        return $this->model->where($data)->orderBy($orderBy)->get();
    }
}
