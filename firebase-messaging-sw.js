importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

  const firebaseConfig = {
        apiKey: "AIzaSyCKuCRd4g1cpK0JUpE4LiZEBAruuPEslSU",
        authDomain: "reapbucks-app-rewords.firebaseapp.com",
        projectId: "reapbucks-app-rewords",
        storageBucket: "reapbucks-app-rewords.firebasestorage.app",
        messagingSenderId: "49877699544",
        appId: "1:49877699544:web:6159119cbabca8b7b040ad",
        measurementId: "G-D1TKN2TEGG"
  };

firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    //console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body,
        icon:notification.icon
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
});