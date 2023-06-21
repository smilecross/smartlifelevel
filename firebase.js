// <script type="module"> はindex.htmlのheadの中に指定
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-app.js";


import {
    getFirestore,
    collection,
    addDoc,
    serverTimestamp,
} from "https://www.gstatic.com/firebasejs/9.22.1/firebase-firestore.js";

const firebaseConfig = {
    apiKey: "AIzaSyCdrBKHvAaI6i7tbUk5ZC1_l6llNuujQSg",
    authDomain: "smartlifecheck-d8100.firebaseapp.com",
    projectId: "smartlifecheck-d8100",
    storageBucket: "smartlifecheck-d8100.appspot.com",
    messagingSenderId: "246749471005",
    appId: "1:246749471005:web:7212e6f9c54da989dac1f4"
};

const app = initializeApp(firebaseConfig);

const db = getFirestore(app);

// data-point-num
// クリック操作

$("button").on("click", function () {
    // 送信時に必要な処理
});
console.log(firebaseだよ);
// htmlへの書き込み

const postData = {
    level: $("#level").val(),
};
addDoc(collection(db, "smartlifecheck"), postData);
