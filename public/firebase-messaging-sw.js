importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-messaging-compat.js');

const firebaseConfig = {
    apiKey: "AIzaSyAznd4TQOC06Rtt8wJaQ3_uwOGeaJjYAJY",
    authDomain: "courierxpress-f1854.firebaseapp.com",
    projectId: "courierxpress-f1854",
    storageBucket: "courierxpress-f1854.firebasestorage.app",
    messagingSenderId: "392394215283",
    appId: "1:392394215283:web:dec4a8c94ce96ff0067f06",
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

// Lắng nghe thông báo đẩy khi khách hàng đang tắt tab hoặc thu nhỏ trình duyệt xuống dưới thanh Taskbar
messaging.onBackgroundMessage((payload) => {
    console.log('Nhận thông báo ngầm:', payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: '/images/logo-icon.png' // Icon đại diện hiển thị của CourierXpress
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
