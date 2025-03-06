import Toastify from "toastify-js";
import { customColors } from './colors'; 

export function showNotification(message, variant) {
    Toastify({
        text: message,
        duration: 3000,
        position: 'right',
        gravity: 'top',
        backgroundColor: variant === 'success' ? customColors.success : variant === 'error' ? customColors.error : customColors.warning,
        close: false,
    }).showToast();
}