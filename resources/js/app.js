import $ from "jquery";
import "datatables.net-dt";
import Swal from "sweetalert2";
import "./bootstrap";

// Membuat $ dan jQuery tersedia secara global di seluruh halaman
window.$ = $;
window.jQuery = $;

console.log("Vite app.js loaded!");

// Tambahkan jQuery code kamu di bawah ini
$(function () {
    console.log("jQuery ready!");
});
