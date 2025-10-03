    var translations = `{!! session("trans") !!}`;

    function trans(key) {
        var trans = JSON.parse(translations);
        return (trans[key] != null ? trans[key] : key);
    }

    $(document).ready(function () {
        var notificationListUrl = window.location.origin + "/admin/notification"; 

        function load_unseen_new_order_notification() {
            $.ajax({
                url: notificationListUrl, 
                method: 'GET',
                success: function (response) {
                    $('#order_notification_box').html(''); 
                    
                    // Display Unread Notifications
                    if (response.unread.length > 0) {
                        $.each(response.unread, function (index, value) {
                            var message = value.data.data; // Adjust this based on your notification structure
                            var view_url = "/admin/view-order/" + value.id; // Adjust URL as needed
                            var markAsReadUrl = "{{ route('mark-as-read', ':id') }}".replace(':id', value.id);
                            var deleteUrl = "{{ route('notifications.delete', ':id') }}".replace(':id', value.id);
        
                            var html = `
                                <li class="notification-item unread bg-light p-3 rounded shadow-sm mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="font-weight-bold text-primary">● New Notification</span>
                                            <p class="mb-1 text-dark">${message}</p>
                                            <small class="text-muted">${new Date(value.created_at).toLocaleString()}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="${view_url}" class="text-muted mx-2" title="View Order">
                                                <i class="fal fa-eye"></i>
                                            </a>
                                            <a href="${markAsReadUrl}" class="text-muted mx-2" title="Mark as read">
                                                <i class="fal fa-check-circle"></i>
                                            </a>
                                            <a href="${deleteUrl}" class="text-muted mx-2" title="Delete">
                                                <i class="fal fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>`;
                            $('#order_notification_box').append(html); 
                        });
                    } else {
                        $('#order_notification_box').append('<li class="text-muted">No new notifications.</li>');
                    }
        
                    // Display Read Notifications
                    if (response.read.length > 0) {
                        $.each(response.read, function (index, value) {
                            var message = value.data.data; 
                            var view_url = "/admin/view-order/" + value.id; 
                            var deleteUrl = "{{ route('notifications.delete', ':id') }}".replace(':id', value.id);
        
                            var html = `
                                <li class="notification-item p-3 rounded shadow-sm mb-2 border">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="font-weight-bold">Payment Received</span>
                                            <p class="mb-1 text-dark">${message}</p>
                                            <small class="text-muted">${new Date(value.created_at).toLocaleString()}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="${view_url}" class="text-muted mx-2" title="View Order">
                                                <i class="fal fa-eye"></i>
                                            </a>
                                            <a href="${deleteUrl}" class="text-muted mx-2" title="Delete">
                                                <i class="fal fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>`;
                            $('#order_notification_box').append(html); // Append the read notification
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error loading notifications:', error);
                }
            });
        }
        
        load_unseen_new_order_notification();

        setInterval(function () {
            load_unseen_new_order_notification();
        }, 30000);

    });
