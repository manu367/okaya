// graph
class Graph{
    constructor(){
            this.adjList=new Map();
    }
    addVertex(vertex){
        if (!this.adjList.has(vertex)){
            this.adjList.set(vertex,[]);
        }
    }
    addEdge(v1,v2){
        if(this.adjList.has(v1) && this.adjList.has(v2)) {
            this.adjList.get(v1).push(v2); // directed edge
        }
    }

    printGraph() {
        for(let [vertex, edges] of this.adjList) {
            console.log(vertex + " -> " + edges.join(", "));
        }
    }
}
const g = new Graph();
g.addVertex("A");
g.addVertex("B");
g.addVertex("C");
g.addEdge("A", "B");
g.addEdge("A", "C");
g.printGraph();


/*
278 = 100 days = 3days
 */