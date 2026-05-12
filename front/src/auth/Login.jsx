import { useEffect, useState } from "react";
import AuthLayout from "./AuthLayout";
import { navigateTo } from "../navigation";
import { getCurrentUser, submitLaravelForm } from "../lib/laravelAuth";

function Login() {
  const [errors, setErrors] = useState({});
  const [message, setMessage] = useState("");
  const [submitting, setSubmitting] = useState(false);

  useEffect(() => {
    let active = true;

    getCurrentUser().then((user) => {
      if (active && user) {
        navigateTo("/dashboard");
      }
    });

    return () => {
      active = false;
    };
  }, []);

  async function handleSubmit(event) {
    event.preventDefault();
    setErrors({});
    setMessage("");
    setSubmitting(true);

    const form = new FormData(event.currentTarget);
    const result = await submitLaravelForm("/login", {
      email: form.get("email"),
      password: form.get("password"),
      remember: form.get("remember") ? "1" : "",
    });

    setSubmitting(false);

    if (!result.ok) {
      setErrors(result.errors);
      setMessage(result.message);
      return;
    }

    navigateTo("/dashboard");
  }

  return (
    <AuthLayout eyebrow="Welcome back" title="Login to your account">
      <form className="auth-card" onSubmit={handleSubmit}>
        {message ? <p className="auth-alert">{message}</p> : null}

        <label>
          Email
          <input name="email" type="email" autoComplete="email" required />
          {errors.email ? <span>{errors.email}</span> : null}
        </label>

        <label>
          Password
          <input
            name="password"
            type="password"
            autoComplete="current-password"
            required
          />
          {errors.password ? <span>{errors.password}</span> : null}
        </label>

        <div className="auth-row">
          <label className="auth-check">
            <input name="remember" type="checkbox" />
            Remember me
          </label>
          <a
            href="/forgot-password"
            onClick={(event) => {
              event.preventDefault();
              navigateTo("/forgot-password");
            }}
          >
            Forgot password?
          </a>
        </div>

        <button type="submit" disabled={submitting}>
          {submitting ? "Logging in..." : "Login"}
        </button>

        <p className="auth-switch">
          Need an account?{" "}
          <a
            href="/sign-up"
            onClick={(event) => {
              event.preventDefault();
              navigateTo("/sign-up");
            }}
          >
            Sign up
          </a>
        </p>
      </form>
    </AuthLayout>
  );
}

export default Login;
