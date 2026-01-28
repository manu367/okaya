class Graph{
    constructor() {
        this.adjacency=new Map();
    }
    addNode(data){
        if(this.adjacency.has(data))return;
        this.adjacency.set(data,new Node(data));
    }
    addEdge(data1,data2){

    }
    shortestPath(){}
    printgrpah(){}

}

class Node {
    constructor(data) {
        this.data = data;
        this.behaviour = null;
    }
}

class Linkedlist {
    constructor() {
        this.head = null;
    }

    addNode(data) {
        const node = new Node(data);

        if (this.head === null) {
            this.head = node;
            return; // 👈 THIS is the missing shield
        }

        let temp = this.head;
        while (temp.behaviour !== null) {
            temp = temp.behaviour;
        }
        temp.behaviour = node;
    }

    deleteNode(data) {
        // agar list empty hai
        if (this.head === null) return false;

        // agar head hi target hai
        if (this.head.data === data) {
            this.head = this.head.behaviour;
            return true;
        }

        let prev = this.head;
        let curr = this.head.behaviour;

        while (curr !== null) {
            if (curr.data === data) {
                prev.behaviour = curr.behaviour; // chain reconnect
                return true;
            }
            prev = curr;
            curr = curr.behaviour;
        }

        return false; // nahi mila
    }

    find(v) {
        let result = { isExist: false, position: -1, value: null };

        if (this.head === null) return result;

        let temp = this.head;
        let i = 0;

        while (temp !== null) {
            if (temp.data === v) {
                return {
                    isExist: true,
                    position: i,
                    value: temp.data
                };
            }
            temp = temp.behaviour;
            i++;
        }

        return result;
    }

    print() {
        let temp = this.head;
        while (temp !== null) {
            console.log(temp.data);
            temp = temp.behaviour;
        }
    }
}

import crypto from "crypto";

class BlockChainScheduler {
    constructor() {
        this.algorithm = "aes-256-cbc";
        this.secretKey = crypto
            .createHash("sha256")
            .update("mera-secret-key")
            .digest();
    }

    createBlock(data) {
        const iv = crypto.randomBytes(16);

        const cipher = crypto.createCipheriv(
            this.algorithm,
            this.secretKey,
            iv
        );

        let encrypted = cipher.update(String(data), "utf8", "hex");
        encrypted += cipher.final("hex");

        return {
            iv: iv.toString("hex"),
            encryptedData: encrypted
        };
    }

    getOriginalNumber(block) {
        const decipher = crypto.createDecipheriv(
            this.algorithm,
            this.secretKey,
            Buffer.from(block.iv, "hex")
        );

        let decrypted = decipher.update(block.encryptedData, "hex", "utf8");
        decrypted += decipher.final("utf8");

        return Number(decrypted);
    }
}

// Usage
const scheduler = new BlockChainScheduler();

const block = scheduler.createBlock(12);
console.log("Encrypted Block:", block);

const original = scheduler.getOriginalNumber(block);
console.log("Decrypted Number:", original);




