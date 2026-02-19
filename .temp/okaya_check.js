function User(name,password){
    this.name=name;
    this.password=password;
}
function AdminUser(name,password){
    this.name=name;
    this.password=password;
}
User.prototype.getName = function(){
    return this.name;
}
User.prototype.getPassword = function(){
    return this.password;
}
AdminUser.prototype.getName = function(){
    return this.name;
}
AdminUser.prototype.getPassword = function(){
    return this.password;
}
const user=new User("Manu Pathak","12");
const admin=new AdminUser("Manu Pathak","4");
console.log(user.getName());
console.log(user.getPassword());
console.log(admin.getName());
console.log(admin.getPassword());
