<?
namespace App\Exceptions\Handlers;
use App\Interfaces\ExceptionHandlerInterface;
use Illuminate\Http\JsonResponse;
use Throwable;

class UserNotAuthorisedException implements ExceptionHandlerInterface
{
    public function handle(Throwable $exception): JsonResponse
    {
        return response()->json([
            'success'=>false,
            'error' => $this->getMessage($exception),
        ], $this->getStatusCode($exception));
    }

    public function getMessage(Throwable $exception): string
    {
        return 'User is not authorised to perform this action.';
    }

    public function getStatusCode(Throwable $exception): int
    {
        return 401;
    }
}