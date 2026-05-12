import { navigateTo } from "../navigation";

function AuthLayout({ eyebrow, title, children }) {
  return (
    <main className="auth-shell">
      <section className="auth-panel">
        <a
          className="auth-brand"
          href="/"
          onClick={(event) => {
            event.preventDefault();
            navigateTo("/");
          }}
        >
          <span className="auth-brand-mark">B</span>
          <span>Bisklet</span>
        </a>

        <div className="auth-copy">
          <p>{eyebrow}</p>
          <h1>{title}</h1>
          <span>
            Manage your account, listings, and messages from one secure place.
          </span>
        </div>
      </section>

      <section className="auth-form-section">
        <div className="auth-form-wrap">{children}</div>
      </section>
    </main>
  );
}

export default AuthLayout;
