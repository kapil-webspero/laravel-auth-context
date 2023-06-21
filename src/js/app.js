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
