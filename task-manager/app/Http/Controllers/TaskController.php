<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\TaskIndexRequest;
use App\Http\Resources\PriorityTaskResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @OA\Tag(
 *     name="Tasks",
 *     description="Operations related to tasks"
 * )
 */
class TaskController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Get a list of tasks with optional filtering by status",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         required=false,
     *         description="Filter tasks by their status",
     *         @OA\Schema(type="string", enum={"TODO", "IN_PROGRESS", "COMPLETED"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of tasks"
     *     )
     * )
     */
    public function index(TaskIndexRequest $request)
    {
        $status = isset($request->status) ? $request->status : null;

        return TaskResource::collection(Task::status($status)->get());
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Create a new task",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"title", "description", "status", "importance", "deadline"},
     *             properties={
     *                 @OA\Property(property="title", type="string", example="New Task"),
     *                 @OA\Property(property="description", type="string", example="This is a description for a new task."),
     *                 @OA\Property(property="status", type="string", enum={"TODO", "IN_PROGRESS", "COMPLETED"}, example="TODO"),
     *                 @OA\Property(property="importance", type="integer", example=3, minimum=1, maximum=5),
     *                 @OA\Property(property="deadline", type="string", format="date-time", example="2024-12-01 12:00:00")
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task created successfully"
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Invalid data provided",
     *          @OA\JsonContent(
     *              type="object",
     *              properties={
     *                  @OA\Property(property="message", type="string", example="The given data was invalid."),
     *                  @OA\Property(property="errors", type="object",
     *                      properties={
     *                          @OA\Property(property="importance", type="array", items=@OA\Items(type="string", example="Укажите важность задачи.")),
     *                          @OA\Property(property="title", type="array", items=@OA\Items(type="string", example="Заголовок задачи обязателен."))
     *                      }
     *                  )
     *              }
     *          )
     *      )
     * )
     */
    public function store(StoreRequest $request)
    {
        $task = Task::create($request->all());

        return new TaskResource($task);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Get a single task by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the task to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task found"
     * ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     )
     * )
     */
    public function find($id)
    {
        $task = Task::query()->findOrFail($id);

        return new TaskResource($task);
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Update an existing task",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="The ID of the task to update",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"title", "description", "status", "importance", "deadline"},
     *              properties={
     *                  @OA\Property(property="title", type="string", example="Updated Task Title"),
     *                  @OA\Property(property="description", type="string", example="Updated task description."),
     *                  @OA\Property(property="status", type="string", enum={"TODO", "IN_PROGRESS", "COMPLETED"}, example="IN_PROGRESS"),
     *                  @OA\Property(property="importance", type="integer", example=4, minimum=1, maximum=5),
     *                  @OA\Property(property="deadline", type="string", format="date-time", example="2024-12-01T12:00:00Z")
     *              }
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Task updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     )
     * )
     */
    public function edit(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'data' => ['message' => 'Task not found']
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

        $task->update($request->all());

        return new TaskResource($task);
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Delete a task",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the task to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Task deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Task not found")
     *         )
     *     )
     * )
     */
    public function delete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'data' => ['message' => 'Task not found']
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

        $task->delete();

        return response()->json(['data' => ['message' => 'Task deleted successfully']], ResponseAlias::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/priority",
     *     tags={"Tasks"},
     *     summary="Get prioritized list of tasks",
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks sorted by priority"
     *     )
     * )
     */
    public function getPriority()
    {
        $tasks = Task::all();

        $tasks = $tasks->map(function ($task) {
            $task->priority_score = $task->getPriorityAttributes();
            $task->is_overdue = $task->getIsOverdueAttribute();
            return $task;
        });

        $tasks = $tasks->sortByDesc('priority_score');

        return PriorityTaskResource::collection($tasks);
    }
}
