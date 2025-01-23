<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;

class LogController extends Controller
{
    public function index()
    {
        $logs = $this->getCustomLogs(); 

        $laravelLogs = $this->getLaravelLogs();

        $allLogs = collect($logs)->merge($laravelLogs)->sortByDesc('date');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $paginatedLogs = new LengthAwarePaginator(
            $allLogs->slice(($currentPage - 1) * $perPage, $perPage), 
            $allLogs->count(), 
            $perPage, 
            $currentPage, 
            ['path' => LengthAwarePaginator::resolveCurrentPath()] 
        );

        return view('admin.log.index', compact('paginatedLogs'));
    }

    private function getLaravelLogs()
    {
        $filePath = storage_path('logs/laravel.log');
    
        if (!File::exists($filePath)) {
            return [];
        }
    
        $lines = File::lines($filePath);
        $logs = [];
    
        foreach ($lines as $key => $line) {
            preg_match('/\[(.*?)\] (.*?): (.*)/', $line, $matches);
    
            if (count($matches) === 4) {
                if($matches[1] == 'object') continue;
                if($matches[1] == 'previous exception') {
                    $matches[1] = end($logs)['date'];
                }
                $logs[] = [
                    'date' => $matches[1],
                    'type' => $matches[2],
                    'message' => $matches[3],
                    'user' => 'N/A',
                    'data' => [],
                ];
            }
        }
    
        return $logs;
    }

    private function getCustomLogs()
    {
        $logPath = storage_path('logs/main.log');
    
        if (!File::exists($logPath)) {
            return view('logs.index', ['logs' => []]);
        }
    
        $logContent = File::get($logPath);
        $logLines = array_filter(explode("\n", $logContent));
    
        $logs = array_map(function ($line) {
            $logData = json_decode(substr($line, strpos($line, '{')), true);
    
            preg_match('/\[(.*?)\] (.*?)\.([a-zA-Z]+): (.+)/', $line, $matches);
            
            return [
                'date' => $matches[1] ?? 'N/A',
                'type' => strtoupper($matches[3] ?? 'N/A'),
                'message' => isset($matches[4]) ?  explode('{', $matches[4])[0] : 'N/A',
                'user' => $logData['user'] ?? 'Desconhecido',
                'data' => $logData['data'] ?? [],
            ];
        }, $logLines);

        return $logs;
    }
}
