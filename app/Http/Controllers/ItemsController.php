<?php

namespace App\Http\Controllers;

use Dingo\Api\Http\Response;
use HttpRequestException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Repositories\ItemRepository;
use App\Validators\ItemValidator;

/**
 * Class ItemsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ItemsController extends Controller
{
    /**
     * @var ItemRepository
     */
    protected $repository;

    /**
     * @var ItemValidator
     */
    protected $validator;

    /**
     * ItemsController constructor.
     *
     * @param ItemRepository $repository
     * @param ItemValidator $validator
     */
    public function __construct(ItemRepository $repository, ItemValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $items = $this->repository->all();

        return response()->json([
            'data' => $items,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ItemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ItemCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $item = $this->repository->create($request->all());

            $response = [
                'message' => 'Item created.',
                'data'    => $item->toArray(),
            ];



            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->repository->find($id);


        return response()->json([
            'data' => $item,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ItemUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ItemUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $item = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Item updated.',
                'data'    => $item->toArray(),
            ];


            return response()->json($response);

        } catch (ValidatorException $e) {


            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);


        return response()->json([
            'message' => 'Item deleted.',
            'deleted' => $deleted,
        ]);

    }
}
