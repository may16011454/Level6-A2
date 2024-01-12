from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time


#Selenium code to register a user then add another user through the admin dashboard

# Launch Chrome
driver = webdriver.Chrome()
driver.maximize_window()

# Open the website
driver.get('http://localhost/logan/A2/A2(New)/app/index.php') 

# Create a new account
register_link = driver.find_element(By.XPATH, '/html/body/div[2]/div/div[2]/div/div/a')
register_link.click()

# Fill in registration details
firstname_input = driver.find_element(By.ID, 'fname')
firstname_input.send_keys('TestUser')

lastname_input = driver.find_element(By.ID, 'sname')
lastname_input.send_keys('Selenium')

email_input = driver.find_element(By.ID, 'email')
email_input.send_keys('Selenium@tests.com')

password_input = driver.find_element(By.ID, 'password')
password_input.send_keys('Password.11')

confirm_password_input = driver.find_element(By.ID, 'password-v')
confirm_password_input.send_keys('Password.11')

# Submit  register form
register_button = driver.find_element(By.XPATH, '/html/body/form/section/div/div/div/div/div/button')
register_button.click()

time.sleep(2)

# Log in as admin
# Fill in login details
login_email_input = driver.find_element(By.ID, 'email')
login_email_input.send_keys('admin@admin.com') 

login_password_input = driver.find_element(By.ID, 'password')
login_password_input.send_keys('Password.11') 

# Submit the login form
login_button = driver.find_element(By.XPATH, '/html/body/form/section/div/div/div/div/div/button')
login_button.click()

time.sleep(2)

# Go to the add user page
add_user_link = driver.find_element(By.XPATH, '/html/body/div/div/div[1]/div/div[2]/a')
add_user_link.click()

# Add user button
add_user_button = driver.find_element(By.XPATH, '/html/body/div/a')
add_user_button.click()

# Fill in information
firstname_input = driver.find_element(By.ID, 'firstname')
firstname_input.send_keys('Selenium')

lastname_input = driver.find_element(By.ID, 'lastname')
lastname_input.send_keys('Testerererer')

email_input = driver.find_element(By.ID, 'email')
email_input.send_keys('selenium@testinger.com')

password_input = driver.find_element(By.ID, 'password')
password_input.send_keys('Password.11')

# Select role from the dropdown
role_dropdown = Select(driver.find_element(By.ID, 'role'))
role_dropdown.select_by_value('2') 

# Submit  form
submit_button = driver.find_element(By.XPATH, '/html/body/form/section/div/div/div/div/div/button')
submit_button.click()

time.sleep(2)

# Close the browser
driver.quit()
