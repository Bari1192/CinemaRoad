using OpenQA.Selenium;
using OpenQA.Selenium.Firefox;
using OpenQA.Selenium.Support.UI;

namespace SelectorPageTests;

[TestClass]
public class SelectorPageTests
{
    private WebDriver _webDdriver;
    private const string _sut = "http://frontend.cinemaroad/Selector";

    [TestInitialize]
    public void InitializeWebDriver()
    {
        var firefoxOptions = new FirefoxOptions();
        
        _webDdriver = new FirefoxDriver(firefoxOptions);
    }

    [TestCleanup]
    public void TeardownWebDriver()
    {
        _webDdriver.Quit();
    }
    
    [TestMethod]
    public void PageIsLoaded()
    {
        _webDdriver.Url = _sut;
        Assert.IsNotNull(_webDdriver);
    }
    
    [TestMethod]
    public void MoviesLoadedCorrectly()
    {
        var locationUrl = "http://frontend.cinemaroad/LocationChoose";
        _webDdriver.Manage().Window.Size = new System.Drawing.Size(1920, 1080); // optional, for consistent layout
        _webDdriver.Navigate().GoToUrl(locationUrl);
        var wait = new WebDriverWait(_webDdriver, TimeSpan.FromSeconds(20));
        wait.Until(driver => driver.FindElement(By.XPath("//img[@alt='Starfield']")));
        var image = _webDdriver.FindElement(By.XPath("//img[@alt='Starfield']"));
        image.Click();
        
        
        
        
        var elements = wait.Until(driver =>
        {
            var elems = driver.FindElements(By.CssSelector("div.bg-slate-800.rounded-lg"));
            return elems.Count > 0 ? elems : null;
        });
        Console.WriteLine($"Found {elements.Count} main container divs after waiting.");
        Assert.IsTrue(elements.Count > 0, "No main movie container divs found with class 'bg-slate-800 rounded-lg'");
    }
    
    [TestMethod]
    public void FilterByGenre()
    {
        var locationUrl = "http://frontend.cinemaroad/LocationChoose";
        _webDdriver.Navigate().GoToUrl(locationUrl);

        var wait = new WebDriverWait(_webDdriver, TimeSpan.FromSeconds(10));

        wait.Until(driver => driver.FindElement(By.XPath("//img[@alt='Starfield']")));
        var image = _webDdriver.FindElement(By.XPath("//img[@alt='Starfield']"));
        image.Click();

        wait.Until(driver => driver.Url == _sut);

        var allButton = wait.Until(driver => driver.FindElement(By.XPath("//button[text()='Mind']")));

        Assert.IsNotNull(allButton); 
    }
    
    [TestMethod]
    public void CardClickRoute()
    {
        var locationUrl = "http://frontend.cinemaroad/LocationChoose";
        _webDdriver.Navigate().GoToUrl(locationUrl);
        var wait = new WebDriverWait(_webDdriver, TimeSpan.FromSeconds(10));
        wait.Until(driver => driver.FindElement(By.XPath("//img[@alt='Starfield']")));
        var image = _webDdriver.FindElement(By.XPath("//img[@alt='Starfield']"));
        image.Click();
        wait.Until(driver => driver.Url == _sut);
        wait.Until(driver => driver.FindElement(By.CssSelector("div.flex-row.hidden.mt-2.lg\\:flex")));        

        var screeningButton = wait.Until(driver =>
        {
            var buttons = driver.FindElements(By.CssSelector("button.bg-white.text-lg.font-semibold.mx-1.rounded-lg.p-2"));
            return buttons.Count > 0 ? buttons[0] : null;
        });
        screeningButton.Click();

        wait.Until(driver => driver.Url.Contains("/ParkingSpotChooser"));
        Assert.IsTrue(_webDdriver.Url.Contains("/ParkingSpotChooser"),
            $"Expected redirect to /ParkingSpotChooser but got {_webDdriver.Url}");
    }
}