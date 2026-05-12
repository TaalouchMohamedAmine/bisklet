import { useEffect, useState } from "react";
import { navigateTo } from "../navigation";
import { getCurrentUser, submitLaravelForm } from "../lib/laravelAuth";

function Dashboard() {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    let active = true;

    getCurrentUser().then((currentUser) => {
      if (!active) {
        return;
      }

      if (!currentUser) {
        navigateTo("/login");
        return;
      }

      setUser(currentUser);
      setLoading(false);
    });

    return () => {
      active = false;
    };
  }, []);

  async function handleLogout() {
    await submitLaravelForm("/logout", {});
    navigateTo("/login");
  }

  if (loading) {
    return (
      <main className="front-dashboard">
        <section>
          <p>Dashboard</p>
          <h1>Loading your account...</h1>
        </section>
      </main>
    );
  }

  return (
    <main className="front-dashboard">
      <header>
        <a
          href="/"
          onClick={(event) => {
            event.preventDefault();
            navigateTo("/");
          }}
        >
          Bisklet
        </a>
        <button type="button" onClick={handleLogout}>
          Logout
        </button>
      </header>

      <section>
        <p>Dashboard</p>
        <h1>Welcome, {user.name}.</h1>
        <span>
          You are signed in as {user.email}. This is the frontend dashboard
          connected to the Laravel backend.
        </span>
      </section>
    </main>
  );
}

export default Dashboard;
