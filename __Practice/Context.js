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

// tanstack-query probelm resolver
// step 1: QueryClient setup in Main applications  and <QuieryClientProvier>
//step 2: create api functions in
// getAll =  const {data,isloading , error}=useQuery({querykey , queryFn});
// getBy id = const {data , isLoading }=useQuery({queryeykey , queryfn});

/*
*  setp1 : const client=useQueryClient ();
* add=useMutation({
* mutationsfc=addUser,
* onSucess:()=>{
* queryclient =invalidQueries(["users"])
* }
* });
*
* add.mutations({name ,email , ...data});
* */