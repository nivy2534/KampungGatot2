/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#0f203c", // biru
                secondary: "#EF4444", // kuning-oranye
                softcream: "#e8ebf0", // warna custom
            },
        },
    },
    plugins: [],
};
