function showDetails(section) {
    if (!section || typeof section !== "string") {
        alert("Error: Invalid section. Please select a valid option.");
        return;
    }

    if (section === "Analytics Overview") {
        alert("Navigating to Analytics Overview...");
        window.location.href = "analytics-overview.html";
    } else if (section === "Quick Actions") {
        alert("Navigating to Quick Actions...");
        window.location.href = "quick-actions.html";
    } else {
        alert("Error: Section not recognized. Please try again.");
    }
}
