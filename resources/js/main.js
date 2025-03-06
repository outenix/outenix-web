// resources/js/main.js
import { authRegister, authLogin, authGoogle } from './utils/auth';
import {
    handleSettingsNavigation,
    handleDeleteDevice,
    handleClearDevice,
    handleEditAccount,
    handleRedirectToGoogle
} from './pages/settings';
import { 
    handleDetailGroups, 
    handlePaginationTopUsers,
    handlePaginationSort,
    handlePaginationSearch
 } from './pages/groupdetails';

document.addEventListener('DOMContentLoaded', () => {
    const { pathname } = window.location;

    // Buat variabel baru untuk mendeteksi rute group dinamis
    const isGroupRoute = /^\/group\/\d+$/.test(pathname);

    switch (true) {
        case pathname === '/login':
            authLogin();
            authGoogle();
            break;

        case pathname === '/register':
            authRegister();
            break;

        case pathname === '/settings':
            handleSettingsNavigation();
            handleEditAccount();
            handleDeleteDevice();
            handleClearDevice();
            handleRedirectToGoogle();
            break;

        case isGroupRoute:
            handleDetailGroups();
            handlePaginationTopUsers();
            handlePaginationSort();
            handlePaginationSearch();
            break;

        default:
            break;
    }
});
