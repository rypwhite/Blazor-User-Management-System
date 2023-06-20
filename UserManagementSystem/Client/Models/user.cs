public class User
{
    public int UID { get; set; }
    public string? FirstName { get; set; }
    public string? LastName { get; set; }
    public int Age { get; set; }
    public string? Address { get; set; }
    public string? EmailAddress { get; set; }
    public string? PhoneNumber { get; set; }

    public User(int uid, string firstName, string lastName, int age, string address, string emailAddress, string phoneNumber)
    {
        UID = uid;
        FirstName = firstName;
        LastName = lastName;
        Age = age;
        Address = address;
        EmailAddress = emailAddress;
        PhoneNumber = phoneNumber;
    }
}
