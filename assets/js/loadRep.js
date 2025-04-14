export function loadRep (id) {
    const repdict = {
        "report1": "mvc_kmom01_report.txt",
        "report2": "mvc_kmom02_report.txt",
        "report3": "mvc_kmom03_report.txt",
        "report4": "mvc_kmom04_report.txt",
        "report5": "mvc_kmom05_report.txt"
    };

    if (id in repdict) {
        console.log("Report exists.");
        let viewer = document.querySelector(reportViewer);
        let selected = fetch(`/reports/${id}`)
        viewer.innerHTML = "<pre>" + selected + "</pre>";
    } else {
        console.log("No such report.");
    }
}
