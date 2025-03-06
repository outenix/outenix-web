export function refreshErrorQueryLogs() {
    fetch('/refresh-error-query-logs', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest', // Identifikasi request sebagai AJAX
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Failed to fetch error logs. Status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.html) {
                const errorQueryLogsDiv = document.getElementById('errorQueryLogsContainer');
                if (errorQueryLogsDiv) {
                    errorQueryLogsDiv.innerHTML = data.html;
                }
            } else {
                console.error('Invalid response format:', data);
            }
        })
        .catch((error) => {
            console.error('Error refreshing error logs:', error);
        });
}

export function searchErrorQueryLogs(query) {
    fetch(`/search-error-query-logs?search=${encodeURIComponent(query)}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest', // Identifikasi request sebagai AJAX
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Failed to search error logs. Status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.html) {
                console.log('Response HTML:', data.html);
                const errorQueryLogsDiv = document.getElementById('errorQueryLogsContainer');
                if (errorQueryLogsDiv) {
                    errorQueryLogsDiv.innerHTML = data.html;
                }
            } else {
                console.error('Invalid response format:', data);
            }
        })
        .catch((error) => {
            console.error('Error searching error logs:', error);
        });
}
