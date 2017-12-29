<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    /**
     * @var string $_modelClass
     */
    protected $_modelClass;

    /**
     * @var string $_model
     */
    protected $_model;

    /**
     * @var int $_perRequest
     */
    protected $_per_page = 15;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->_initModel();
    }

    /**
     *  Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $created = $this->_model->create($request->all());
        } catch (\Exception $e) {
            return $this->_info(false, 500, $e->getMessage());
        }
        if ($created) {
            $message = 'You are successfully created';

            return $this->_info(true, 200, $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = $this->_model->find($id);
        } catch (\Exception $e) {
            return $this->_info(false, 500, $e->getMessage());
        }

        return $this->_single(true, 200, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $item = $this->_model->findOrFail($id);
        try {
            $item->update($request->all());
        } catch (\Exception $e) {
            return $this->_info(false, 500, $e->getMessage());
        }
        if ($item) {
            $message = 'You are successfully created';

            return $this->_info(true, 200, $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $deleteItem = $this->_model->findOrFail($id)->delete();
        } catch (\Exception $e) {
            return $this->_info(false, 500, $e->getMessage());
        }

        if ($deleteItem) {
            $message = 'You are successfully deleted';
            return $this->_info(true, 200, $message);
        }
    }

    /**
     * Check and initialize Model
     * @throws \Exception
     */
    protected function _initModel()
    {
        if (!class_exists($this->_modelClass)) {
            throw new \Exception("Model $this->_modelClass not found");
        }

        $this->_model = App::make($this->_modelClass);
    }

    /**
     * @param boolean $status
     * @param number $code
     * @param string {null} $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function _info($status, $code, $message = null)
    {
        $data = [
            'success' => $status
        ];
        if (!is_null($message)) {
            $data['message'] = $message;
        }

        return response()->json($data, $code);
    }

    /**
     * @param boolean $status
     * @param number $code
     * @param object $object
     * @return \Illuminate\Http\JsonResponse
     */
    protected function _single($status, $code, $object)
    {
        $data = [
            'success' => $status,
            'data' => $object
        ];

        return response()->json($data, $code);
    }
}