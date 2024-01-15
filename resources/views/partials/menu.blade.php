<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('properties_menu_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/properties*") ? "c-show" : "" }} {{ request()->is("admin/sections*") ? "c-show" : "" }} {{ request()->is("admin/units*") ? "c-show" : "" }} {{ request()->is("admin/equipment-types*") ? "c-show" : "" }} {{ request()->is("admin/equipments*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.propertiesMenu.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('property_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.properties.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/properties") || request()->is("admin/properties/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.property.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('section_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.sections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sections") || request()->is("admin/sections/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.section.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('unit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.units.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/units") || request()->is("admin/units/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hotel c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.unit.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('equipment_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.equipment-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/equipment-types") || request()->is("admin/equipment-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-solar-panel c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.equipmentType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('equipment_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.equipments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/equipments") || request()->is("admin/equipments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-solar-panel c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.equipment.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('contact_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/landlords*") ? "c-show" : "" }} {{ request()->is("admin/tenants*") ? "c-show" : "" }} {{ request()->is("admin/maintainers*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-address-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contact.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('landlord_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.landlords.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/landlords") || request()->is("admin/landlords/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.landlord.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tenant_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tenants.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tenants") || request()->is("admin/tenants/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-user-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tenant.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('maintainer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.maintainers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/maintainers") || request()->is("admin/maintainers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-address-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.maintainer.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('accounting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/expense-types*") ? "c-show" : "" }} {{ request()->is("admin/expenses*") ? "c-show" : "" }} {{ request()->is("admin/invoice-types*") ? "c-show" : "" }} {{ request()->is("admin/invoices*") ? "c-show" : "" }} {{ request()->is("admin/income-types*") ? "c-show" : "" }} {{ request()->is("admin/incomes*") ? "c-show" : "" }} {{ request()->is("admin/invoice-recurrings*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.accounting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('expense_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-types") || request()->is("admin/expense-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expenses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expenses") || request()->is("admin/expenses/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expense.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('invoice_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.invoice-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/invoice-types") || request()->is("admin/invoice-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-invoice c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.invoiceType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('invoice_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.invoices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/invoices") || request()->is("admin/invoices/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.invoice.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.income-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/income-types") || request()->is("admin/income-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-money-bill-wave c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.incomeType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.incomes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-money-check-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.income.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('invoice_recurring_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.invoice-recurrings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/invoice-recurrings") || request()->is("admin/invoice-recurrings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-invoice-dollar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.invoiceRecurring.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('documents_menu_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/document-types*") ? "c-show" : "" }} {{ request()->is("admin/documents*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-folder c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.documentsMenu.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('document_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.document-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/document-types") || request()->is("admin/document-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-archive c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.documentType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('document_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.documents.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/documents") || request()->is("admin/documents/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-copy c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.document.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/application-settings*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('application_setting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.application-settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/application-settings") || request()->is("admin/application-settings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.applicationSetting.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('application_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.applications.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/applications") || request()->is("admin/applications/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-folder-open c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.application.title') }}
                </a>
            </li>
        @endcan
        @can('frontend_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/hero-sections*") ? "c-show" : "" }} {{ request()->is("admin/features-sections*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.frontendSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('hero_section_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.hero-sections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/hero-sections") || request()->is("admin/hero-sections/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.heroSection.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('features_section_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.features-sections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/features-sections") || request()->is("admin/features-sections/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.featuresSection.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>