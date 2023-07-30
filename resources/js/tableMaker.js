const projectTableDiv = document.queryselector("div.projectTable")
let tableHeaders = ["Project", "Members", "Estimated Hours", "Actions"]

const createProjecttTable = () => {
    while (projectTableDiv.firstChild) projectTableDiv.removeChild(projectTableDiv.firstChild) 

    let projectTable = document.createElement("table")
    

}