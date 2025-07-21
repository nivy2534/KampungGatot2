import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8000", // Ganti sesuai dengan URL API Laravel kamu
  withCredentials: true, // jika pakai cookie/session
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});


export default api;
