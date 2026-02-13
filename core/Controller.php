<?php

class Controller
{
    protected function view($view, $data = [])
    {
        $viewPath = "../app/views/$view.php";

        // View Not Found
        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "404 - View Not Found";
            exit;
        }
        extract($data); // This line converts array keys into variables. $data = ['users' => $users];
        // after using extract becomes $users = $users

        require $viewPath;  // manually pass variables.
    }

    protected function setFlash($type, $message)
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message,
            'time' => time()
        ];
    }

    protected function showFlash()
    {
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $type = $flash['type'];
            $message = $flash['message'];

            $bgColor = ($type == 'success') ? '#10b981' : '#ef4444';
            $icon = ($type == 'success') ?
                '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>' :
                '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>';

            echo "
        <style>
            .toast-flash {
                position: fixed;
                top: 20px;
                right: 20px;
                min-width: 300px;
                max-width: 400px;
                background: {$bgColor};
                color: white;
                border-radius: 8px;
                padding: 16px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                z-index: 9999;
                animation: slideIn 0.3s ease-out forwards;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            }
            
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
            
            .toast-flash.hide {
                animation: slideOut 0.3s ease-in forwards;
            }
            
            .toast-content {
                display: flex;
                align-items: center;
                gap: 12px;
                flex: 1;
            }
            
            .toast-icon {
                width: 20px;
                height: 20px;
                flex-shrink: 0;
            }
            
            .toast-message {
                font-size: 14px;
                font-weight: 500;
                line-height: 1.5;
                flex: 1;
            }
            
            .toast-close {
                background: none;
                border: none;
                color: white;
                cursor: pointer;
                padding: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 4px;
                transition: background 0.2s;
                opacity: 0.8;
            }
            
            .toast-close:hover {
                background: rgba(255,255,255,0.2);
                opacity: 1;
            }
            
            .toast-close svg {
                width: 16px;
                height: 16px;
            }
            
            .toast-progress {
                position: absolute;
                bottom: 0;
                left: 0;
                height: 3px;
                background: rgba(255,255,255,0.5);
                width: 100%;
                border-radius: 0 0 8px 8px;
                animation: progress 5s linear forwards;
            }
            
            @keyframes progress {
                from { width: 100%; }
                to { width: 0%; }
            }
            
            @media (max-width: 640px) {
                .toast-flash {
                    top: 10px;
                    right: 10px;
                    left: 10px;
                    min-width: auto;
                    max-width: none;
                }
            }
        </style>
        
        <div class='toast-flash' id='toastFlash'>
            <div class='toast-content'>
                <span class='toast-icon'>{$icon}</span>
                <span class='toast-message'>{$message}</span>
            </div>
            <button class='toast-close' onclick='hideToast()'>
                <svg fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'/>
                </svg>
            </button>
            <div class='toast-progress'></div>
        </div>
        
        <script>
            function hideToast() {
                const toast = document.getElementById('toastFlash');
                toast.classList.add('hide');
                setTimeout(() => {
                    if (toast && toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }
            
            // Auto hide after 5 seconds
            setTimeout(hideToast, 5000);
            
            // Allow clicking anywhere on toast to hide (optional)
            document.getElementById('toastFlash').addEventListener('click', function(e) {
                if (!e.target.closest('.toast-close')) {
                    hideToast();
                }
            });
        </script>
        ";

            unset($_SESSION['flash']);
        }
    }
}
