# Proton Auth Context Package

This is a Laravel package that provides authentication context functionality using Proton. It allows you to easily integrate Proton login functionality into your Laravel application.

## Installation

1. Run the following command to install the package:

   ```shell
   composer require home-bloks/proton-auth-context:dev-main
   ```

2. Run the Proton authentication command:

   ```shell
   php artisan proton:auth
   ```

3. Install the required npm packages:

   ```shell
   npm install
   ```

4. Compile the assets:

   ```shell
   npm run dev
   ```

## Configuration for VITE

1. Update your `vite.config.js` file by adding the following code:

   ```javascript
   import { defineConfig } from 'vite';
   import laravel from 'laravel-vite-plugin';
   import react from "@vitejs/plugin-react";

   export default defineConfig({
       plugins: [
           laravel({
               input: ['resources/css/app.css', 'resources/js/app.js'],
               refresh: true,
           }),
           react(),
       ],
   });
   ```

2. Update your root JavaScript (entry point for react) file (e.g., `App.jsx`, `app.jsx`, `Main.jsx`) with the following code:

   ```jsx
   import ReactDOM from "react-dom/client";
   import ProtonLoginButton from "./components/ProtonLoginButton";
   import { AuthContextProvider } from "./store/auth.context.jsx";

   ReactDOM.createRoot(document.getElementById("root")).render(
     <>
       <AuthContextProvider>
         <ProtonLoginButton />
       </AuthContextProvider>
     </>
   );
   ```

3. Add the following code to your root template header before closing the `</head>` tag (welcome.blade.php by default):

   ```html
   @viteReactRefresh
   @vite(['resources/js/app.jsx'])
   ```

   Note: Make sure the `@vite('resources/js/app.jsx')` file matches the root JavaScript file you updated.

4. Place the following code where you want to add the `ProtonLoginButton` component:

   ```html
   <div id="root"></div>
   ```

   You can change the `id` attribute according to your setup in the root JavaScript file.
   
 5. update your .env with following varibales:
   ```
      VITE_MAINNET_ACCOUNT=account_name
      VITE_MAINNET_CHAIN_NETWORK_ENDPOINTS=https://protontestnet.greymass.com
      VITE_MAINNET_CHAIN_ID=71ee83bcf52142d61019d95f9cc5427ba6a0d7ff8accd9e2088ae2abeaf3d3dd
   ```
