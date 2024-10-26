<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Telegram\Bot\Api;

class ExportAndSendBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->exportDB();
        $this->sendToTelegram($filePath);
        $this->deleteTempFile($filePath);
    }

    private function sendToTelegram(string $filePath)
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        try {
            $telegram->sendDocument([
                'chat_id' => 1839876800,
                'document' => fopen($filePath, 'r'),
                'caption' => 'Бэкап базы данных ' . now()->timezone('Europe/Moscow')->format('d.m.Y H:i'),
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка отправки файла в Telegram: ' . $e->getMessage());
            return false;
        }

        return true;
    }

    private function exportDB()
    {
        $dbHost = env('DB_HOST', 'localhost');
        $dbUser = env('DB_USERNAME', 'root');
        $dbPass = env('DB_PASSWORD', '');
        $dbName = env('DB_DATABASE', 'database');
        $dbPort = env('DB_PORT', 3306);

        // Создаём временный файл
        $tempFile = tempnam(sys_get_temp_dir(), 'db_backup_') . '.sql';

        $command = sprintf(
            'mysqldump -h%s -P%s -u%s -p\'%s\' %s > %s',
            $dbHost,
            $dbPort,
            $dbUser,
            $dbPass,
            $dbName,
            $tempFile
        );

        $process = Process::fromShellCommandline($command);

        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            Log::error('Ошибка экспорта базы данных ' . $exception->getMessage());
            return false;
        }
        return $tempFile;
    }

    private function deleteTempFile($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

}
