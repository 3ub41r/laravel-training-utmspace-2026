<script>
        // Default configuration
        const defaultConfig = {
            dashboard_title: "University Academic Dashboard",
            university_name: "State University",
            academic_year: "Academic Year 2023-2024"
        };

        // Chart colors
        const colors = {
            primary: '#4299e1',
            secondary: '#ed8936',
            success: '#38a169',
            warning: '#d69e2e',
            danger: '#e53e3e',
            info: '#3182ce',
            purple: '#805ad5',
            pink: '#d53f8c',
            teal: '#319795'
        };

        // Initialize charts
        function initializeCharts() {
            // Enrollment by Faculty Chart
            const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
            new Chart(enrollmentCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Engineering', 'Business', 'Sciences', 'Liberal Arts', 'Medicine', 'Education'],
                    datasets: [{
                        data: [6234, 4567, 5123, 3890, 2456, 2297],
                        backgroundColor: [
                            colors.primary,
                            colors.secondary,
                            colors.success,
                            colors.warning,
                            colors.danger,
                            colors.purple
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });

            // Performance Distribution Chart
            const performanceCtx = document.getElementById('performanceChart').getContext('2d');
            new Chart(performanceCtx, {
                type: 'bar',
                data: {
                    labels: ['A (90-100)', 'B (80-89)', 'C (70-79)', 'D (60-69)', 'F (0-59)'],
                    datasets: [{
                        label: 'Students',
                        data: [8234, 9876, 4567, 1234, 656],
                        backgroundColor: [
                            colors.success,
                            colors.info,
                            colors.warning,
                            colors.secondary,
                            colors.danger
                        ],
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Research Funding Chart
            const fundingCtx = document.getElementById('fundingChart').getContext('2d');
            new Chart(fundingCtx, {
                type: 'polarArea',
                data: {
                    labels: ['Medicine', 'Sciences', 'Engineering', 'Business', 'Liberal Arts', 'Education'],
                    datasets: [{
                        data: [4.2, 3.1, 2.3, 1.8, 1.2, 0.9],
                        backgroundColor: [
                            colors.danger + '80',
                            colors.success + '80',
                            colors.primary + '80',
                            colors.secondary + '80',
                            colors.warning + '80',
                            colors.purple + '80'
                        ],
                        borderColor: [
                            colors.danger,
                            colors.success,
                            colors.primary,
                            colors.secondary,
                            colors.warning,
                            colors.purple
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true
                            }
                        }
                    },
                    scales: {
                        r: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return '$' + value + 'M';
                                }
                            }
                        }
                    }
                }
            });

            // Student Satisfaction Chart
            const satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
            new Chart(satisfactionCtx, {
                type: 'radar',
                data: {
                    labels: ['Teaching Quality', 'Campus Facilities', 'Student Support', 'Career Services', 'Research Opportunities', 'Campus Life'],
                    datasets: [{
                        label: 'Satisfaction Score',
                        data: [4.2, 3.8, 4.1, 3.9, 4.0, 4.3],
                        backgroundColor: colors.primary + '20',
                        borderColor: colors.primary,
                        borderWidth: 2,
                        pointBackgroundColor: colors.primary,
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 5,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // 5-Year Trends Chart
            const trendsCtx = document.getElementById('trendsChart').getContext('2d');
            new Chart(trendsCtx, {
                type: 'line',
                data: {
                    labels: ['2019', '2020', '2021', '2022', '2023'],
                    datasets: [
                        {
                            label: 'Total Enrollment',
                            data: [22456, 23123, 23789, 24234, 24567],
                            borderColor: colors.primary,
                            backgroundColor: colors.primary + '20',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Graduation Rate (%)',
                            data: [83.2, 84.1, 85.7, 86.8, 87.3],
                            borderColor: colors.success,
                            backgroundColor: colors.success + '20',
                            tension: 0.4,
                            yAxisID: 'y1'
                        },
                        {
                            label: 'Research Funding ($M)',
                            data: [11.2, 12.1, 12.8, 13.2, 13.5],
                            borderColor: colors.secondary,
                            backgroundColor: colors.secondary + '20',
                            tension: 0.4,
                            yAxisID: 'y2'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        y2: {
                            type: 'linear',
                            display: false,
                            position: 'right'
                        }
                    }
                }
            });
        }

        // Update last updated time
        function updateLastUpdated() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            document.getElementById('last-updated').textContent = `Last Updated: ${timeString}`;
        }

        // Element SDK configuration
        async function onConfigChange(config) {
            document.getElementById('dashboard-title').textContent =
                config.dashboard_title || defaultConfig.dashboard_title;
            document.getElementById('university-name').textContent =
                config.university_name || defaultConfig.university_name;
            document.getElementById('academic-year').textContent =
                config.academic_year || defaultConfig.academic_year;
        }

        function mapToCapabilities(config) {
            return {
                recolorables: [],
                borderables: [],
                fontEditable: undefined,
                fontSizeable: undefined
            };
        }

        function mapToEditPanelValues(config) {
            return new Map([
                ['dashboard_title', config.dashboard_title || defaultConfig.dashboard_title],
                ['university_name', config.university_name || defaultConfig.university_name],
                ['academic_year', config.academic_year || defaultConfig.academic_year]
            ]);
        }

        // Handle logout functionality
        function handleLogout(event) {
            event.preventDefault();

            // Create custom confirmation modal
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
            `;

            const modalContent = document.createElement('div');
            modalContent.style.cssText = `
                background: white;
                border-radius: 16px;
                padding: 32px;
                max-width: 400px;
                width: 90%;
                text-align: center;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            `;

            modalContent.innerHTML = `
                <div style="font-size: 48px; margin-bottom: 16px;">🚪</div>
                <h3 style="margin: 0 0 16px 0; color: #2d3748; font-size: 20px;">Confirm Logout</h3>
                <p style="margin: 0 0 24px 0; color: #718096;">Are you sure you want to logout from the dashboard?</p>
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <button id="cancelLogout" style="
                        padding: 12px 24px;
                        border: 2px solid #e2e8f0;
                        background: white;
                        color: #4a5568;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    ">Cancel</button>
                    <button id="confirmLogout" style="
                        padding: 12px 24px;
                        border: 2px solid #e53e3e;
                        background: #e53e3e;
                        color: white;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    ">Logout</button>
                </div>
            `;

            modal.appendChild(modalContent);
            document.body.appendChild(modal);

            // Handle button clicks
            document.getElementById('cancelLogout').onclick = () => {
                document.body.removeChild(modal);
            };

            document.getElementById('confirmLogout').onclick = () => {
                document.body.removeChild(modal);

                // Show logout success message
                const successModal = document.createElement('div');
                successModal.style.cssText = modal.style.cssText;

                const successContent = document.createElement('div');
                successContent.style.cssText = modalContent.style.cssText;
                successContent.innerHTML = `
                    <div style="font-size: 48px; margin-bottom: 16px;">✅</div>
                    <h3 style="margin: 0 0 16px 0; color: #38a169; font-size: 20px;">Logged Out Successfully</h3>
                    <p style="margin: 0 0 24px 0; color: #718096;">You have been safely logged out of the system.</p>
                    <button onclick="document.body.removeChild(this.closest('div'))" style="
                        padding: 12px 24px;
                        border: 2px solid #38a169;
                        background: #38a169;
                        color: white;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    ">OK</button>
                `;

                successModal.appendChild(successContent);
                document.body.appendChild(successModal);

                // Auto-remove after 3 seconds
                setTimeout(() => {
                    if (document.body.contains(successModal)) {
                        document.body.removeChild(successModal);
                    }
                }, 3000);
            };

            // Close modal when clicking outside
            modal.onclick = (e) => {
                if (e.target === modal) {
                    document.body.removeChild(modal);
                }
            };
        }

        // Handle navigation clicks
        function handleNavClick(event, section) {
            event.preventDefault();

            // Show toast notification
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 80px;
                right: 24px;
                background: rgba(66, 153, 225, 0.95);
                color: white;
                padding: 16px 24px;
                border-radius: 12px;
                font-weight: 600;
                z-index: 10000;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            toast.textContent = `Navigating to ${section}...`;

            document.body.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);

            // Remove after 3 seconds
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 300);
            }, 2700);
        }

        // Add click handlers to navigation items
        function initializeNavigation() {
            const navItems = document.querySelectorAll('.dropdown-item');
            navItems.forEach(item => {
                if (!item.classList.contains('danger')) {
                    item.addEventListener('click', (e) => {
                        const text = item.querySelector('span:last-child').textContent;
                        handleNavClick(e, text);
                    });
                }
            });
        }

        // Initialize everything
        document.addEventListener('DOMContentLoaded', function () {
            initializeCharts();
            updateLastUpdated();
            initializeNavigation();

            // Update time every minute
            setInterval(updateLastUpdated, 60000);

            // Initialize Element SDK
            if (window.elementSdk) {
                window.elementSdk.init({
                    defaultConfig,
                    onConfigChange,
                    mapToCapabilities,
                    mapToEditPanelValues
                });
            }
        });
    </script>