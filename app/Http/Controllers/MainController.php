<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;
use Arcanedev\LogViewer\Contracts\Utilities\Filesystem;

use Log;
class MainController extends Controller
{
    public function index(){
        $server_check_version = '1.0.4';
        $start_time = microtime(TRUE);
    
        $operating_system = PHP_OS_FAMILY;
    
        if ($operating_system === 'Windows') {
            // Win CPU
            $wmi = new COM('WinMgmts:\\\\.');
            $cpus = $wmi->InstancesOf('Win32_Processor');
            $cpuload = 0;
            $cpu_count = 0;
            foreach ($cpus as $key => $cpu) {
                $cpuload += $cpu->LoadPercentage;
                $cpu_count++;
            }
            // WIN MEM
            $res = $wmi->ExecQuery('SELECT FreePhysicalMemory,FreeVirtualMemory,TotalSwapSpaceSize,TotalVirtualMemorySize,TotalVisibleMemorySize FROM Win32_OperatingSystem');
            $mem = $res->ItemIndex(0);
            $memtotal = round($mem->TotalVisibleMemorySize / 1000000,2);
            $memavailable = round($mem->FreePhysicalMemory / 1000000,2);
            $memused = round($memtotal-$memavailable,2);
            // WIN CONNECTIONS
            $connections = shell_exec('netstat -nt | findstr :80 | findstr ESTABLISHED | find /C /V ""'); 
            $totalconnections = shell_exec('netstat -nt | findstr :80 | find /C /V ""');
        } else {
            // Linux CPU
            $load = sys_getloadavg();
            $cpuload = $load[0];
            // Linux MEM
            $free = shell_exec('free');
            $free = (string)trim($free);
            $free_arr = explode("\n", $free);
            $mem = explode(" ", $free_arr[1]);
            $mem = array_filter($mem, function($value) { return ($value !== null && $value !== false && $value !== ''); }); // removes nulls from array
            $mem = array_merge($mem); // puts arrays back to [0],[1],[2] after 
            $memtotal = round($mem[1] / 1000000,2);
            $memused = round($mem[2] / 1000000,2);
            $memfree = round($mem[3] / 1000000,2);
            $memshared = round($mem[4] / 1000000,2);
            $memcached = round($mem[5] / 1000000,2);
            $memavailable = round($mem[6] / 1000000,2);
            // Linux Connections
            $connections = `netstat -ntu | grep :80 | grep ESTABLISHED | grep -v LISTEN | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -rn | grep -v 127.0.0.1 | wc -l`; 
            $totalconnections = `netstat -ntu | grep :80 | grep -v LISTEN | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -rn | grep -v 127.0.0.1 | wc -l`; 
        }
    
        $memusage = round(($memavailable/$memtotal)*100);
    
    
    
        $phpload = round(memory_get_usage() / 1000000,2);
    
        $diskfree = round(disk_free_space(".") / 1000000000);
        $disktotal = round(disk_total_space(".") / 1000000000);
        $diskused = round($disktotal - $diskfree);
    
        $diskusage = round($diskused/$disktotal*100);
    
        if ($memusage > 85 || $cpuload > 85 || $diskusage > 85) {
            $trafficlight = 'red';
        } elseif ($memusage > 50 || $cpuload > 50 || $diskusage > 50) {
            $trafficlight = 'orange';
        } else {
            $trafficlight = '#2F2';
        }
    
        $end_time = microtime(TRUE);
        $time_taken = $end_time - $start_time;
        $total_time = round($time_taken,4);
        $log_file = config('log-viewer.storage-path');
        $object_log_config = (object) ["current_path"=>$log_file,"pattern_prefix"=> config('log-viewer.pattern.prefix'),"pattern_date"=>config('log-viewer.pattern.date'),"pattern_extension"=>config('log-viewer.pattern.extension')];
        Log::info('Showing user profile for user: ');
        return view('index',["log_config"=>$object_log_config,'ram'=>$memusage,"cpu"=>$cpuload,"disk_usage"=>$diskusage,"memtotal"=>$memtotal,"memusage"=>$memused,"disk_used"=>$diskused,"disk_total"=>$disktotal,"server_name"=>$_SERVER['SERVER_NAME'],"server_addr"=>$_SERVER['REMOTE_ADDR'],"php_version"=>PHP_VERSION,"php_load"=>$phpload,"load_time"=>$total_time]);
    }

    public function post(Request $request){
      try{

    
        if(!$request->filled("log_path")){
            $log_path = storage_path('logs');
        } else{
            $log_path = $request->input("log_path");
        }

        if(!$request->filled("prefix_pattern")){
            $prefix_pattern =  Filesystem::PATTERN_PREFIX;
        } else {
            $prefix_pattern = $request->input("prefix_pattern");
        }
    
        if(!$request->filled("date_pattern")){
            $date_pattern =  Filesystem::PATTERN_DATE;
        } else {
            $date_pattern = $request->input("date_pattern");
        }

        if(!$request->filled("extension_pattern")){
            $extension_pattern =  Filesystem::PATTERN_EXTENSION;
        } else {
            $extension_pattern = $request->input("extension_pattern");
        }
        $write_file = $this->writeFileConfig($log_path,$prefix_pattern,$date_pattern,$extension_pattern);
        if($write_file){
            Session::flash("success_write_config","Failed To Write Config");
            return redirect()->back();
        } else {
            Session::flash("failed_write_config","Failed To Write Config");
            return redirect()->back();
        }

      } catch(Exception $e){
        Log::error($e->getMessage());
        Session::flash("failed_write_config","Failed To Write Config");
        return redirect()->back();

      }
  
    }



    private function writeFileConfig($path_file,$prefix_pattern,$date_pattern,$extension_pattern){
        try{
            /*
                Get File Contents
            */
            $config_file_backup = config_path('log-config/log-viewer.install');
            $get_file = file_get_contents($config_file_backup);
            
            /*
                Setup Array Replace
            */
            $array_replace = array(
            "LUNATIC_LOG_STORAGE_PATH"=>$path_file,
            "LUNATIC_LOG_PATTERN_PREFIX"=>$prefix_pattern,
            "LUNATIC_LOG_PATTERN_DATE"=>$date_pattern,
            "LUNATIC_LOG_PATTERN_EXTENSION"=>$extension_pattern);
            
            /*
                Change Text With STRTR
            */

            $change_text = strtr($get_file,$array_replace);

            /**
             *  Write Config File 
             */
            $open_file = fopen(config_path('log-viewer.php'),'w');
            fwrite($open_file,$change_text);
            fclose($open_file);
            return true;
        }catch(Exception $e){
            Log::error($e->getMessage());
            return false;
        }    
    }

    public function login(){
        return view('login');
    }

    public function postLogin(Request $request){
        if($request->input("pin") === env('LOG_VIEWER_PASSWORD')){
            Session::put('authenticated',true);
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    public function postLogout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
