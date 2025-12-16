function toggleStatus(event, dataKey, itemId, routeTemplate) {
    const element = event.target;
    if (!element) return;

    if (!routeTemplate) {
        console.error('Route not found on element.');
        return;
    }

    const newValue = element.checked ? 1 : 0;

    const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenElement) {
        console.error('CSRF token meta tag not found!');
        return;
    }
    const csrfToken = csrfTokenElement.getAttribute('content');
    const url = routeTemplate.replace(':id', itemId);
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ [dataKey]: newValue })
    })
    .then(response => response.json())
    .then(data => {
        notifyToastr(data.type, data.title, data.message);
        if (data.success && dataKey === 'is_home') {
            setTimeout(() => window.location.reload(), 2000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        notifyToastr('error', 'Request Failed', 'An error occurred while updating.');
    });
}