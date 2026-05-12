import { useState } from "react";
import AuthLayout from "./AuthLayout";
import { navigateTo } from "../navigation";
import { submitLaravelForm } from "../lib/laravelAuth";

function ResetPassword() {
  const [errors, setErrors] = useState({});
  const [message, setMessage] = useState("");
  const [submitting, setSubmitting] = useState(false);
  const token = window.location.pathname.split("/").pop();
  const email = new URLSearchParams(window.location.search).get("email") ?? "";

  async function handleSubmit(event) {
    event.preventDefault();
    setErrors({});
    setMessage("");
    setSubmitting(true);

    const form = new FormData(event.currentTarget);
    const result = await submitLaravelForm(
      "/reset-password",
      {
        token,
        email: form.get("email"),
        password: form.get("password"),
        password_confirmation: form.get("password_confirmation"),
      },
      `/reset-password/${token}?email=${encodeURIComponent(email)}`,
    );

    setSubmitting(false);

    if (!result.ok) {
      setErrors(result.errors);
      setMessage(result.message);
      return;
    }

    navigateTo("/login");
  }

  return (
    <AuthLayout eyebrow="New password" title="Choose a secure password">
      <form className="auth-card" onSubmit={handleSubmit}>
        {message ? <p className="auth-alert">{message}</p> : null}

        <label>
          Email
          <input
            name="email"
            type="email"
            autoComplete="email"
            defaultValue={email}
            required
          />
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
          {submitting ? "Resetting..." : "Reset password"}
        </button>
      </form>
    </AuthLayout>
  );
}

export default ResetPassword;
