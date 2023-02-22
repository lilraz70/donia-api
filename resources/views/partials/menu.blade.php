<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('content_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/content-categories*") ? "menu-open" : "" }} {{ request()->is("admin/content-tags*") ? "menu-open" : "" }} {{ request()->is("admin/content-pages*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/content-categories*") ? "active" : "" }} {{ request()->is("admin/content-tags*") ? "active" : "" }} {{ request()->is("admin/content-pages*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.contentManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('content_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-categories.index") }}" class="nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-tags.index") }}" class="nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-pages.index") }}" class="nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentPage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('faq_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/faq-categories*") ? "menu-open" : "" }} {{ request()->is("admin/faq-questions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/faq-categories*") ? "active" : "" }} {{ request()->is("admin/faq-questions*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.faqManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faq_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-categories.index") }}" class="nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('faq_question_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-questions.index") }}" class="nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('parameter_user_type_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.parameter-user-types.index") }}" class="nav-link {{ request()->is("admin/parameter-user-types") || request()->is("admin/parameter-user-types/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.parameterUserType.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('favori_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.favoris.index") }}" class="nav-link {{ request()->is("admin/favoris") || request()->is("admin/favoris/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.favori.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('comment_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.comments.index") }}" class="nav-link {{ request()->is("admin/comments") || request()->is("admin/comments/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.comment.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('license_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.licenses.index") }}" class="nav-link {{ request()->is("admin/licenses") || request()->is("admin/licenses/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.license.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('notification_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.notifications.index") }}" class="nav-link {{ request()->is("admin/notifications") || request()->is("admin/notifications/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.notification.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('carpooling_vehicle_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.carpooling-vehicles.index") }}" class="nav-link {{ request()->is("admin/carpooling-vehicles") || request()->is("admin/carpooling-vehicles/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.carpoolingVehicle.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('energy_type_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.energy-types.index") }}" class="nav-link {{ request()->is("admin/energy-types") || request()->is("admin/energy-types/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.energyType.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('rating_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.ratings.index") }}" class="nav-link {{ request()->is("admin/ratings") || request()->is("admin/ratings/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.rating.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('trip_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.trips.index") }}" class="nav-link {{ request()->is("admin/trips") || request()->is("admin/trips/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.trip.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('trip_frequency_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.trip-frequencies.index") }}" class="nav-link {{ request()->is("admin/trip-frequencies") || request()->is("admin/trip-frequencies/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.tripFrequency.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('accept_cgu_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.accept-cgus.index") }}" class="nav-link {{ request()->is("admin/accept-cgus") || request()->is("admin/accept-cgus/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.acceptCgu.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('userservice_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.userservices.index") }}" class="nav-link {{ request()->is("admin/userservices") || request()->is("admin/userservices/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.userservice.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('userparam_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.userparams.index") }}" class="nav-link {{ request()->is("admin/userparams") || request()->is("admin/userparams/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.userparam.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('signaler_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.signalers.index") }}" class="nav-link {{ request()->is("admin/signalers") || request()->is("admin/signalers/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.signaler.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('approve_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.approves.index") }}" class="nav-link {{ request()->is("admin/approves") || request()->is("admin/approves/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.approve.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('carpool_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.carpools.index") }}" class="nav-link {{ request()->is("admin/carpools") || request()->is("admin/carpools/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.carpool.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('release_good_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.release-goods.index") }}" class="nav-link {{ request()->is("admin/release-goods") || request()->is("admin/release-goods/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.releaseGood.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('release_good_convenience_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.release-good-conveniences.index") }}" class="nav-link {{ request()->is("admin/release-good-conveniences") || request()->is("admin/release-good-conveniences/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.releaseGoodConvenience.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('local_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.locals.index") }}" class="nav-link {{ request()->is("admin/locals") || request()->is("admin/locals/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.local.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('land_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.lands.index") }}" class="nav-link {{ request()->is("admin/lands") || request()->is("admin/lands/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.land.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('local_convenience_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.local-conveniences.index") }}" class="nav-link {{ request()->is("admin/local-conveniences") || request()->is("admin/local-conveniences/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.localConvenience.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('land_doc_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.land-docs.index") }}" class="nav-link {{ request()->is("admin/land-docs") || request()->is("admin/land-docs/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.landDoc.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('lodging_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.lodgings.index") }}" class="nav-link {{ request()->is("admin/lodgings") || request()->is("admin/lodgings/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.lodging.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('hosting_availability_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.hosting-availabilities.index") }}" class="nav-link {{ request()->is("admin/hosting-availabilities") || request()->is("admin/hosting-availabilities/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.hostingAvailability.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('hostingspec_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.hostingspecs.index") }}" class="nav-link {{ request()->is("admin/hostingspecs") || request()->is("admin/hostingspecs/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.hostingspec.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('hosting_service_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.hosting-services.index") }}" class="nav-link {{ request()->is("admin/hosting-services") || request()->is("admin/hosting-services/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.hostingService.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('allmedia_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.allmedias.index") }}" class="nav-link {{ request()->is("admin/allmedias") || request()->is("admin/allmedias/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.allmedia.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('sell_rent_car_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.sell-rent-cars.index") }}" class="nav-link {{ request()->is("admin/sell-rent-cars") || request()->is("admin/sell-rent-cars/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.sellRentCar.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('vehicle_availability_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.vehicle-availabilities.index") }}" class="nav-link {{ request()->is("admin/vehicle-availabilities") || request()->is("admin/vehicle-availabilities/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.vehicleAvailability.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('need_vehicle_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.need-vehicles.index") }}" class="nav-link {{ request()->is("admin/need-vehicles") || request()->is("admin/need-vehicles/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.needVehicle.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('besoin_hebergement_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.besoin-hebergements.index") }}" class="nav-link {{ request()->is("admin/besoin-hebergements") || request()->is("admin/besoin-hebergements/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.besoinHebergement.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('need_land_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.need-lands.index") }}" class="nav-link {{ request()->is("admin/need-lands") || request()->is("admin/need-lands/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.needLand.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('besoin_local_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.besoin-locals.index") }}" class="nav-link {{ request()->is("admin/besoin-locals") || request()->is("admin/besoin-locals/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.besoinLocal.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('parametres_systeme_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/property-types*") ? "menu-open" : "" }} {{ request()->is("admin/type-of-houses*") ? "menu-open" : "" }} {{ request()->is("admin/type-adm-docs*") ? "menu-open" : "" }} {{ request()->is("admin/land-categories*") ? "menu-open" : "" }} {{ request()->is("admin/unit-measures*") ? "menu-open" : "" }} {{ request()->is("admin/type-of-wheels*") ? "menu-open" : "" }} {{ request()->is("admin/type-of-utilities*") ? "menu-open" : "" }} {{ request()->is("admin/motricity-types*") ? "menu-open" : "" }} {{ request()->is("admin/model-of-vehicles*") ? "menu-open" : "" }} {{ request()->is("admin/rim-types*") ? "menu-open" : "" }} {{ request()->is("admin/color-types*") ? "menu-open" : "" }} {{ request()->is("admin/gear-boxes*") ? "menu-open" : "" }} {{ request()->is("admin/vehicle-types*") ? "menu-open" : "" }} {{ request()->is("admin/type-of-trips*") ? "menu-open" : "" }} {{ request()->is("admin/convenience-types*") ? "menu-open" : "" }} {{ request()->is("admin/hosting-types*") ? "menu-open" : "" }} {{ request()->is("admin/servicesinclus*") ? "menu-open" : "" }} {{ request()->is("admin/objecttypes*") ? "menu-open" : "" }} {{ request()->is("admin/rating-types*") ? "menu-open" : "" }} {{ request()->is("admin/type-offers*") ? "menu-open" : "" }} {{ request()->is("admin/payment-modes*") ? "menu-open" : "" }} {{ request()->is("admin/emergency-levels*") ? "menu-open" : "" }} {{ request()->is("admin/reasons*") ? "menu-open" : "" }} {{ request()->is("admin/days*") ? "menu-open" : "" }} {{ request()->is("admin/type-of-media*") ? "menu-open" : "" }} {{ request()->is("admin/set-countries*") ? "menu-open" : "" }} {{ request()->is("admin/cities*") ? "menu-open" : "" }} {{ request()->is("admin/quartiers*") ? "menu-open" : "" }} {{ request()->is("admin/areas-of-services*") ? "menu-open" : "" }} {{ request()->is("admin/configurations*") ? "menu-open" : "" }} {{ request()->is("admin/list-of-countries*") ? "menu-open" : "" }} {{ request()->is("admin/list-statuts*") ? "menu-open" : "" }} {{ request()->is("admin/brands*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/property-types*") ? "active" : "" }} {{ request()->is("admin/type-of-houses*") ? "active" : "" }} {{ request()->is("admin/type-adm-docs*") ? "active" : "" }} {{ request()->is("admin/land-categories*") ? "active" : "" }} {{ request()->is("admin/unit-measures*") ? "active" : "" }} {{ request()->is("admin/type-of-wheels*") ? "active" : "" }} {{ request()->is("admin/type-of-utilities*") ? "active" : "" }} {{ request()->is("admin/motricity-types*") ? "active" : "" }} {{ request()->is("admin/model-of-vehicles*") ? "active" : "" }} {{ request()->is("admin/rim-types*") ? "active" : "" }} {{ request()->is("admin/color-types*") ? "active" : "" }} {{ request()->is("admin/gear-boxes*") ? "active" : "" }} {{ request()->is("admin/vehicle-types*") ? "active" : "" }} {{ request()->is("admin/type-of-trips*") ? "active" : "" }} {{ request()->is("admin/convenience-types*") ? "active" : "" }} {{ request()->is("admin/hosting-types*") ? "active" : "" }} {{ request()->is("admin/servicesinclus*") ? "active" : "" }} {{ request()->is("admin/objecttypes*") ? "active" : "" }} {{ request()->is("admin/rating-types*") ? "active" : "" }} {{ request()->is("admin/type-offers*") ? "active" : "" }} {{ request()->is("admin/payment-modes*") ? "active" : "" }} {{ request()->is("admin/emergency-levels*") ? "active" : "" }} {{ request()->is("admin/reasons*") ? "active" : "" }} {{ request()->is("admin/days*") ? "active" : "" }} {{ request()->is("admin/type-of-media*") ? "active" : "" }} {{ request()->is("admin/set-countries*") ? "active" : "" }} {{ request()->is("admin/cities*") ? "active" : "" }} {{ request()->is("admin/quartiers*") ? "active" : "" }} {{ request()->is("admin/areas-of-services*") ? "active" : "" }} {{ request()->is("admin/configurations*") ? "active" : "" }} {{ request()->is("admin/list-of-countries*") ? "active" : "" }} {{ request()->is("admin/list-statuts*") ? "active" : "" }} {{ request()->is("admin/brands*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.parametresSysteme.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('property_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.property-types.index") }}" class="nav-link {{ request()->is("admin/property-types") || request()->is("admin/property-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.propertyType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('type_of_house_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.type-of-houses.index") }}" class="nav-link {{ request()->is("admin/type-of-houses") || request()->is("admin/type-of-houses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.typeOfHouse.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('type_adm_doc_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.type-adm-docs.index") }}" class="nav-link {{ request()->is("admin/type-adm-docs") || request()->is("admin/type-adm-docs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.typeAdmDoc.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('land_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.land-categories.index") }}" class="nav-link {{ request()->is("admin/land-categories") || request()->is("admin/land-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.landCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('unit_measure_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.unit-measures.index") }}" class="nav-link {{ request()->is("admin/unit-measures") || request()->is("admin/unit-measures/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.unitMeasure.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('type_of_wheel_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.type-of-wheels.index") }}" class="nav-link {{ request()->is("admin/type-of-wheels") || request()->is("admin/type-of-wheels/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.typeOfWheel.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('type_of_utility_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.type-of-utilities.index") }}" class="nav-link {{ request()->is("admin/type-of-utilities") || request()->is("admin/type-of-utilities/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.typeOfUtility.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('motricity_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.motricity-types.index") }}" class="nav-link {{ request()->is("admin/motricity-types") || request()->is("admin/motricity-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.motricityType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('model_of_vehicle_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.model-of-vehicles.index") }}" class="nav-link {{ request()->is("admin/model-of-vehicles") || request()->is("admin/model-of-vehicles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.modelOfVehicle.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('rim_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.rim-types.index") }}" class="nav-link {{ request()->is("admin/rim-types") || request()->is("admin/rim-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.rimType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('color_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.color-types.index") }}" class="nav-link {{ request()->is("admin/color-types") || request()->is("admin/color-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.colorType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('gear_box_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.gear-boxes.index") }}" class="nav-link {{ request()->is("admin/gear-boxes") || request()->is("admin/gear-boxes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.gearBox.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('vehicle_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vehicle-types.index") }}" class="nav-link {{ request()->is("admin/vehicle-types") || request()->is("admin/vehicle-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.vehicleType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('type_of_trip_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.type-of-trips.index") }}" class="nav-link {{ request()->is("admin/type-of-trips") || request()->is("admin/type-of-trips/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.typeOfTrip.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('convenience_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.convenience-types.index") }}" class="nav-link {{ request()->is("admin/convenience-types") || request()->is("admin/convenience-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.convenienceType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('hosting_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.hosting-types.index") }}" class="nav-link {{ request()->is("admin/hosting-types") || request()->is("admin/hosting-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.hostingType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('servicesinclu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.servicesinclus.index") }}" class="nav-link {{ request()->is("admin/servicesinclus") || request()->is("admin/servicesinclus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.servicesinclu.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('objecttype_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.objecttypes.index") }}" class="nav-link {{ request()->is("admin/objecttypes") || request()->is("admin/objecttypes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.objecttype.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('rating_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.rating-types.index") }}" class="nav-link {{ request()->is("admin/rating-types") || request()->is("admin/rating-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ratingType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('type_offer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.type-offers.index") }}" class="nav-link {{ request()->is("admin/type-offers") || request()->is("admin/type-offers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.typeOffer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('payment_mode_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.payment-modes.index") }}" class="nav-link {{ request()->is("admin/payment-modes") || request()->is("admin/payment-modes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.paymentMode.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('emergency_level_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.emergency-levels.index") }}" class="nav-link {{ request()->is("admin/emergency-levels") || request()->is("admin/emergency-levels/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.emergencyLevel.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('reason_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.reasons.index") }}" class="nav-link {{ request()->is("admin/reasons") || request()->is("admin/reasons/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.reason.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('day_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.days.index") }}" class="nav-link {{ request()->is("admin/days") || request()->is("admin/days/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.day.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('type_of_medium_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.type-of-media.index") }}" class="nav-link {{ request()->is("admin/type-of-media") || request()->is("admin/type-of-media/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.typeOfMedium.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('set_country_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.set-countries.index") }}" class="nav-link {{ request()->is("admin/set-countries") || request()->is("admin/set-countries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.setCountry.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('city_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.cities.index") }}" class="nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.city.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('quartier_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.quartiers.index") }}" class="nav-link {{ request()->is("admin/quartiers") || request()->is("admin/quartiers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.quartier.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('areas_of_service_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.areas-of-services.index") }}" class="nav-link {{ request()->is("admin/areas-of-services") || request()->is("admin/areas-of-services/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.areasOfService.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('configuration_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.configurations.index") }}" class="nav-link {{ request()->is("admin/configurations") || request()->is("admin/configurations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.configuration.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('list_of_country_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.list-of-countries.index") }}" class="nav-link {{ request()->is("admin/list-of-countries") || request()->is("admin/list-of-countries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.listOfCountry.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('list_statut_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.list-statuts.index") }}" class="nav-link {{ request()->is("admin/list-statuts") || request()->is("admin/list-statuts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.listStatut.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('brand_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.brands.index") }}" class="nav-link {{ request()->is("admin/brands") || request()->is("admin/brands/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.brand.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('bookreleasegood_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.bookreleasegoods.index") }}" class="nav-link {{ request()->is("admin/bookreleasegoods") || request()->is("admin/bookreleasegoods/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.bookreleasegood.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>