import { useEffect, useState } from "react";
import AuthLayout from "./AuthLayout";
import { navigateTo } from "../navigation";
import { getCurrentUser, submitLaravelForm } from "../lib/laravelAuth";

function SignUp() {
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
    const result = await submitLaravelForm(
      "/sign-up",
      {
        name: form.get("name"),
        email: form.get("email"),
        password: form.get("password"),
        password_confirmation: form.get("password_confirmation"),
      },
      "/sign-up",
    );

    setSubmitting(false);

    if (!result.ok) {
      setErrors(result.errors);
      setMessage(result.message);
      return;
    }

    navigateTo("/dashboard");
  }

  return (
    <AuthLayout eyebrow="Start riding" title="Create your account">
      <form className="auth-card" onSubmit={handleSubmit}>
        {message ? <p className="auth-alert">{message}</p> : null}

        <label>
          Name
          <input name="name" type="text" autoComplete="name" required />
          {errors.name ? <span>{errors.name}</span> : null}
        </label>

        <label>
          Email
          <input name="email" type="email" autoComplete="email" required />
          {errors.email ? <span>{errors.email}</span> : null}
        </label>

        <label>
          Password
          <input name="password" type="password" autoComplete="new-password" required />
          {errors.password ? <span>{errors.password}</span> : null}
        </label>

        <label>
          Confirm password
          <input
            name="password_confirmation"
            type="password"
            autoComplete="new-password"
            required
          />
        </label>

        <button type="submit" disabled={submitting}>
          {submitting ? "Creating..." : "Sign up"}
        </button>

        <p className="auth-switch">
          Already have an account?{" "}
          <a
            href="/login"
            onClick={(event) => {
              event.preventDefault();
              navigateTo("/login");
            }}
          >
            Login
          </a>
        </p>
      </form>
    </AuthLayout>
  );
}

export default SignUp;
