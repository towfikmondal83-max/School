// sw.js - Wahid Tuition Service Worker
// Place in htdocs/ folder on InfinityFree

self.addEventListener('install', function(e) {
    self.skipWaiting();
});

self.addEventListener('activate', function(e) {
    e.waitUntil(clients.claim());
});

self.addEventListener('message', function(e) {
    if (e.data && e.data.type === 'SHOW_NOTIFICATION') {
        self.registration.showNotification(e.data.title || 'Wahid Tuition', {
            body: e.data.body || '',
            vibrate: [100, 50, 100],
            tag: e.data.tag || 'wahid-' + Date.now(),
            renotify: true
        });
    }
});

self.addEventListener('notificationclick', function(e) {
    e.notification.close();
    e.waitUntil(
        clients.matchAll({ type: 'window' }).then(function(list) {
            for (var i = 0; i < list.length; i++) {
                if ('focus' in list[i]) return list[i].focus();
            }
            if (clients.openWindow) return clients.openWindow('/');
        })
    );
});