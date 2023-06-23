public class User
{
    public int UID { get; set; }
    public string? FirstName { get; set; }
    public string? LastName { get; set; }
    public int Age { get; set; }
    public string? Address { get; set; }
    public string? Email { get; set; }
    public string? Phone { get; set; }

    public User(int uid, string firstName, string lastName, int age, string address, string email, string phone)
    {
        UID = uid;
        FirstName = firstName;
        LastName = lastName;
        Age = age;
        Address = address;
        Email = email;
        Phone = phone;
    }
}
