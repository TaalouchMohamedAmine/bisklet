import { useState } from "react";
import AuthLayout from "./AuthLayout";
import { navigateTo } from "../navigation";
import { submitLaravelForm } from "../lib/laravelAuth";

function ForgotPassword() {
  const [errors, setErrors] = useState({});
  const [message, setMessage] = useState("");
  const [submitting, setSubmitting] = useState(false);

  async function handleSubmit(event) {
    event.preventDefault();
    setErrors({});
    setMessage("");
    setSubmitting(true);

    const form = new FormData(event.currentTarget);
    const result = await submitLaravelForm(
      "/forgot-password",
      { email: form.get("email") },
      "/forgot-password",
    );

    setSubmitting(false);

    if (!result.ok) {
      setErrors(result.errors);
      setMessage(result.message);
      return;
    }

    setMessage("Password reset link sent. Check your email or Laravel log.");
  }

  return (
    <AuthLayout eyebrow="Account help" title="Reset your password">
      <form className="auth-card" onSubmit={handleSubmit}>
        {message ? <p className="auth-success">{message}</p> : null}

        <label>
          Email
          <input name="email" type="email" autoComplete="email" required />
          {errors.email ? <span>{errors.email}</span> : null}
        </label>

        <button type="submit" disabled={submitting}>
          {submitting ? "Sending..." : "Send reset link"}
        </button>

        <p className="auth-switch">
          Remembered it?{" "}
          <a
            href="/login"
            onClick={(event) => {
              event.preventDefault();
              navigateTo("/login");
            }}
          >
            Back to login
          </a>
        </p>
      </form>
    </AuthLayout>
  );
}

export default ForgotPassword;
